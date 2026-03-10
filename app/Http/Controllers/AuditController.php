<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function start(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        if (!$organization_id) {
            return back()->with('error', 'You must belong to an organization to start an audit.');
        }

        $request->validate([
            'template_id' => 'required|exists:audit_templates,id',
        ]);

        $audit = Audit::create([
            'organization_id' => $organization_id,
            'template_id' => $request->template_id,
            'created_by' => auth()->id(),
            'status' => 'in_progress'
        ]);

        return redirect()->route('audit.assessment', $audit);
    }

    public function results(Audit $audit)
    {
        // Allow access if user created this audit OR belongs to same org
        $user = auth()->user();
        $sameOrg = $user->organization_id && $user->organization_id === $audit->organization_id;
        $isCreator = $audit->created_by === $user->id;
        if (!$sameOrg && !$isCreator) {
            abort(403);
        }

        $audit->load('results', 'organization');

        // Calculate overall average
        $overallScore = $audit->results->avg('average_score') ?? 0;

        $overallMaturity = 'Beginner';
        if ($overallScore >= 4.5)
            $overallMaturity = 'Excellent';
        elseif ($overallScore >= 3.5)
            $overallMaturity = 'Strong';
        elseif ($overallScore >= 2.5)
            $overallMaturity = 'Solid';
        elseif ($overallScore >= 1.5)
            $overallMaturity = 'Weak';
        else
            $overallMaturity = 'Critical';

        return view('audit.results', compact('audit', 'overallScore', 'overallMaturity'));
    }

    public function report(Audit $audit)
    {
        $user = auth()->user();
        $sameOrg = $user->organization_id && $user->organization_id === $audit->organization_id;
        $isCreator = $audit->created_by === $user->id;
        if (!$sameOrg && !$isCreator) {
            abort(403);
        }

        $audit->load('results', 'organization', 'creator');

        $overallScore = $audit->results->avg('average_score') ?? 0;

        $overallMaturity = 'Beginner';
        if ($overallScore >= 4.5)
            $overallMaturity = 'Excellent';
        elseif ($overallScore >= 3.5)
            $overallMaturity = 'Strong';
        elseif ($overallScore >= 2.5)
            $overallMaturity = 'Solid';
        elseif ($overallScore >= 1.5)
            $overallMaturity = 'Weak';
        else
            $overallMaturity = 'Critical';

        return view('audit.report', compact('audit', 'overallScore', 'overallMaturity'));
    }
}
