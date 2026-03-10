<?php

namespace App\Livewire;

use App\Models\Audit;
use App\Models\Organization;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Audits extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $audit = Audit::findOrFail($id);
        // Only creator can delete
        if ($audit->created_by !== auth()->id()) {
            session()->flash('error', 'You can only delete your own audits.');
            return;
        }
        $audit->delete();
        session()->flash('success', 'Audit deleted.');
    }

    public function render()
    {
        $audits = Audit::with(['organization', 'creator', 'results'])
            ->when($this->search, fn($q) => $q->whereHas(
                'organization',
                fn($oq) =>
                $oq->where('name', 'like', "%{$this->search}%")
            ))
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(15);

        $stats = [
            'total' => Audit::count(),
            'completed' => Audit::where('status', 'completed')->count(),
            'in_progress' => Audit::where('status', 'in_progress')->count(),
        ];

        return view('livewire.audits', compact('audits', 'stats'));
    }
}
