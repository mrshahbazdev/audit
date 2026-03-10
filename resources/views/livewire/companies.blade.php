<div>
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight">{{ __('Companies') }}</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                {{ __('Manage all organizations in the system') }}</p>
        </div>
        <button type="button" wire:click="openCreate"
            class="flex items-center gap-2 bg-primary text-white px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-primary/90 transition-all cursor-pointer w-full sm:w-auto justify-center">
            <span class="material-symbols-outlined text-sm">add</span>
            {{ __('Add Company') }}
        </button>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div
            class="mb-4 flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-5 py-3 rounded-xl font-semibold text-sm">
            <span class="material-symbols-outlined text-green-500">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="mb-4 relative">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
        <input wire:model.live.debounce.300ms="search"
            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all outline-none"
            placeholder="{{ __('Search by name or industry...') }}" type="text" />
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-x-auto">
        <table class="w-full text-left min-w-[500px]">
            <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Company') }}
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Industry') }}
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Size') }}
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">
                        {{ __('Audits') }}</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                        {{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($companies as $company)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="size-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($company->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $company->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $company->industry ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $company->size ?? '—' }}</td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center justify-center size-7 bg-primary/10 text-primary font-bold text-xs rounded-full">
                                {{ $company->audits_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" wire:click="openEdit({{ $company->id }})"
                                    class="p-1.5 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button type="button" wire:click="delete({{ $company->id }})"
                                    wire:confirm="{{ __('Are you sure you want to delete :name?', ['name' => $company->name]) }}"
                                    class="p-1.5 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-slate-400">
                                <span class="material-symbols-outlined text-5xl opacity-40">domain_disabled</span>
                                <p class="font-semibold">{{ __('No companies found') }}</p>
                                <p class="text-sm">
                                    {{ $search ? __('Try a different search term.') : __('Add your first company to get started.') }}
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $companies->links() }}
    </div>

    <!-- Create / Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md border border-slate-200 dark:border-slate-700"
                x-data @click.stop>
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="text-lg font-bold">{{ $editingId ? __('Edit Company') : __('Add New Company') }}</h3>
                    <button type="button" wire:click="$set('showModal', false)"
                        class="text-slate-400 hover:text-red-500 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <form wire:submit.prevent="save" class="p-6 space-y-4">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Company Name') }}
                            <span class="text-red-500">*</span></label>
                        <input wire:model="name" type="text" placeholder="{{ __('e.g. Acme GmbH') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary/30 focus:border-primary text-sm outline-none transition-all" />
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Industry') }}</label>
                        <select wire:model="industry"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary/30 focus:border-primary text-sm outline-none transition-all">
                            <option value="">{{ __('Select industry...') }}</option>
                            <option>{{ __('Technology') }}</option>
                            <option>{{ __('E-Commerce') }}</option>
                            <option>{{ __('Healthcare') }}</option>
                            <option>{{ __('Finance') }}</option>
                            <option>{{ __('Manufacturing') }}</option>
                            <option>{{ __('Consulting') }}</option>
                            <option>{{ __('Marketing') }}</option>
                            <option>{{ __('Real Estate') }}</option>
                            <option>{{ __('Education') }}</option>
                            <option>{{ __('Other') }}</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Company Size') }}</label>
                        <select wire:model="size"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary/30 focus:border-primary text-sm outline-none transition-all">
                            <option value="">{{ __('Select size...') }}</option>
                            <option>1-10</option>
                            <option>11-50</option>
                            <option>51-200</option>
                            <option>201-500</option>
                            <option>500+</option>
                        </select>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" wire:click="$set('showModal', false)"
                            class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-sm hover:bg-primary/90 transition-all cursor-pointer">
                            {{ $editingId ? __('Update Company') : __('Add Company') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>