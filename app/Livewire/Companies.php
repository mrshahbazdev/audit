<?php

namespace App\Livewire;

use App\Models\Organization;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Companies extends Component
{
    use WithPagination;

    // Form state
    public bool $showModal = false;
    public ?int $editingId = null;

    // Form fields
    public string $name = '';
    public string $industry = '';
    public string $size = '';

    // Search
    public string $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'industry' => 'nullable|string|max:255',
        'size' => 'nullable|string|max:100',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $org = Organization::findOrFail($id);
        $this->editingId = $id;
        $this->name = $org->name;
        $this->industry = $org->industry ?? '';
        $this->size = $org->size ?? '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->editingId) {
            Organization::findOrFail($this->editingId)->update([
                'name' => $this->name,
                'industry' => $this->industry ?: null,
                'size' => $this->size ?: null,
            ]);
            session()->flash('success', 'Company updated successfully.');
        } else {
            Organization::create([
                'name' => $this->name,
                'industry' => $this->industry ?: null,
                'size' => $this->size ?: null,
            ]);
            session()->flash('success', 'Company created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Organization::findOrFail($id)->delete();
        session()->flash('success', 'Company deleted.');
    }

    protected function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->industry = '';
        $this->size = '';
        $this->resetValidation();
    }

    public function render()
    {
        $companies = Organization::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('industry', 'like', "%{$this->search}%"))
            ->withCount('audits')
            ->latest()
            ->paginate(10);

        return view('livewire.companies', compact('companies'));
    }
}
