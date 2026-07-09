<?php

namespace Tests\Feature;

use App\Models\Audit;
use App\Models\AuditResult;
use App\Models\Organization;
use App\Models\User;
use App\Services\AllocoreKpiReporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AllocoreKpiReporterTest extends TestCase
{
    use RefreshDatabase;

    protected function makeCompletedAudit(): Audit
    {
        $org = Organization::create(['name' => 'Acme GmbH']);
        $user = User::create([
            'name' => 'Owner',
            'email' => 'owner@acme.test',
            'password' => bcrypt('password'),
            'organization_id' => $org->id,
        ]);

        $audit = Audit::create([
            'organization_id' => $org->id,
            'created_by' => $user->id,
            'status' => 'completed',
        ]);

        $scores = [
            'Umsatz' => 4.0,
            'Gewinn' => 3.0,
            'Ordnung' => 2.0,
            'Einfluss' => 5.0,
            'Vermächtnis' => 1.0,
        ];

        foreach ($scores as $level => $score) {
            AuditResult::create([
                'audit_id' => $audit->id,
                'level' => $level,
                'average_score' => $score,
                'maturity_level' => 'Solid',
                'total_points' => 10,
            ]);
        }

        return $audit;
    }

    public function test_it_pushes_pillar_and_readiness_metrics_to_hub(): void
    {
        config([
            'allocore.enabled' => true,
            'allocore.hub_url' => 'https://hub.allocore.test',
            'allocore.api_key' => 'alc_testkey',
        ]);

        Http::fake([
            'https://hub.allocore.test/api/allocore/kpi/ingest' => Http::response(['ok' => true], 200),
        ]);

        $audit = $this->makeCompletedAudit();

        $ok = app(AllocoreKpiReporter::class)->report($audit);

        $this->assertTrue($ok);

        Http::assertSent(function ($request) {
            if ($request->url() !== 'https://hub.allocore.test/api/allocore/kpi/ingest') {
                return false;
            }
            if ($request->header('X-Allocore-Api-Key')[0] !== 'alc_testkey') {
                return false;
            }

            $body = $request->data();
            $keys = collect($body['metrics'])->pluck('value', 'key');

            return $body['source'] === 'audit'
                && $body['external_ref'] === 'audit-'.$this->getAuditId($body)
                && $keys['enterprise_readiness'] == 3.0 // avg of 4,3,2,5,1
                && $keys['audit.umsatz'] == 4.0
                && $keys['audit.vermaechtnis'] == 1.0;
        });
    }

    protected function getAuditId(array $body): string
    {
        return str_replace('audit-', '', $body['external_ref']);
    }

    public function test_it_skips_when_not_configured(): void
    {
        config([
            'allocore.enabled' => true,
            'allocore.hub_url' => null,
            'allocore.api_key' => null,
        ]);

        Http::fake();

        $audit = $this->makeCompletedAudit();

        $ok = app(AllocoreKpiReporter::class)->report($audit);

        $this->assertFalse($ok);
        Http::assertNothingSent();
    }
}
