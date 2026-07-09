<?php

namespace App\Livewire;

use App\Models\Organization;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AllocoreHub extends Component
{
    public ?Organization $organization = null;

    public string $hubUrl = '';

    public string $apiKey = '';

    public bool $enabled = true;

    public ?string $testStatus = null;   // 'success' | 'error'

    public ?string $testMessage = null;

    // Onboarding: create an organization when the user has none yet.
    public string $newOrgName = '';

    protected function rules(): array
    {
        return [
            'hubUrl' => 'required|url|max:255',
            'apiKey' => 'required|string|max:255',
            'enabled' => 'boolean',
        ];
    }

    public function mount(): void
    {
        $this->loadOrganization();
    }

    protected function loadOrganization(): void
    {
        $this->organization = auth()->user()->organization;

        if ($this->organization) {
            $this->hubUrl = (string) $this->organization->allocore_hub_url;
            $this->apiKey = (string) $this->organization->allocore_api_key;
            $this->enabled = $this->organization->allocore_enabled ?? true;
        }
    }

    /**
     * Create an organization and attach the current user to it, so a freshly
     * registered user can connect the hub (and run audits) self-service.
     */
    public function createOrganization(): void
    {
        $validated = $this->validate([
            'newOrgName' => 'required|string|max:255',
        ]);

        $organization = Organization::create(['name' => $validated['newOrgName']]);

        $user = auth()->user();
        $user->forceFill(['organization_id' => $organization->id])->save();

        $this->reset('newOrgName');
        $this->loadOrganization();
        session()->flash('success', __('Organization created. You can now connect it to the AlloCore Hub.'));
    }

    public function save(): void
    {
        abort_unless($this->organization !== null, 403);
        $this->validate();

        $this->organization->forceFill([
            'allocore_hub_url' => rtrim(trim($this->hubUrl), '/'),
            'allocore_api_key' => trim($this->apiKey),
            'allocore_enabled' => $this->enabled,
            'allocore_status' => 'pending',
        ])->save();

        $this->reset('testStatus', 'testMessage');
        session()->flash('success', __('AlloCore Hub connection saved.'));
    }

    public function disconnect(): void
    {
        abort_unless($this->organization !== null, 403);

        $this->organization->forceFill([
            'allocore_hub_url' => null,
            'allocore_api_key' => null,
            'allocore_status' => null,
            'allocore_last_synced_at' => null,
        ])->save();

        $this->reset('hubUrl', 'apiKey', 'testStatus', 'testMessage');
        $this->enabled = true;
        session()->flash('success', __('Disconnected from AlloCore Hub.'));
    }

    /**
     * Verify the hub URL + API key are valid without pushing real data.
     *
     * We POST an empty metric batch: a valid key that reaches the hub returns
     * 422 (validation: metrics required), while a bad key returns 401. Any
     * other outcome means the URL is unreachable or wrong.
     */
    public function testConnection(): void
    {
        $this->validate();

        $endpoint = rtrim(trim($this->hubUrl), '/').'/api/allocore/kpi/ingest';

        try {
            $response = Http::timeout((int) config('allocore.timeout', 5))
                ->withHeaders(['X-Allocore-Api-Key' => trim($this->apiKey)])
                ->acceptJson()
                ->post($endpoint, ['source' => config('allocore.source', 'audit'), 'metrics' => []]);

            if ($response->status() === 401) {
                $this->testStatus = 'error';
                $this->testMessage = __('The API key was rejected by the hub. Check the key on the hub’s Tools page.');

                return;
            }

            if ($response->status() === 422 || $response->successful()) {
                $this->testStatus = 'success';
                $this->testMessage = __('Connection verified. The hub accepted this API key.');

                return;
            }

            $this->testStatus = 'error';
            $this->testMessage = __('Unexpected response from the hub (:status).', ['status' => $response->status()]);
        } catch (\Throwable $e) {
            $this->testStatus = 'error';
            $this->testMessage = __('Could not reach the hub. Check the hub URL.');
        }
    }

    public function render()
    {
        return view('livewire.allocore-hub');
    }
}
