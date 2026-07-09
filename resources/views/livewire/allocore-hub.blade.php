<div>
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight">{{ __('AlloCore Hub') }}</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                {{ __('Connect this organization to your AlloCore Hub so audit results flow into your central dashboard.') }}
            </p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div
            class="mb-4 flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-5 py-3 rounded-xl font-semibold text-sm">
            <span class="material-symbols-outlined text-green-500">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if($organization === null)
        <!-- No organization: onboarding -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-8 max-w-xl mx-auto">
            <div class="flex flex-col items-center gap-3 text-center mb-6">
                <span class="material-symbols-outlined text-5xl text-primary/50">domain_add</span>
                <p class="font-bold text-lg text-slate-700 dark:text-slate-200">{{ __('Create your organization') }}</p>
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-md">
                    {{ __('You need an organization before connecting to the AlloCore Hub. Create one to get started.') }}
                </p>
            </div>
            <form wire:submit.prevent="createOrganization" class="space-y-4">
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Organization Name') }}
                        <span class="text-red-500">*</span></label>
                    <input wire:model="newOrgName" type="text" placeholder="{{ __('e.g. Acme GmbH') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary/30 focus:border-primary text-sm outline-none transition-all" />
                    @error('newOrgName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                    class="w-full px-5 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-sm hover:bg-primary/90 transition-all cursor-pointer">
                    {{ __('Create Organization') }}
                </button>
            </form>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Connection form -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold">{{ __('Connection') }}</h3>
                    @php($status = $organization->allocore_status)
                    @if($organization->allocoreConnected() && $status === 'connected')
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-300">
                            <span class="size-2 rounded-full bg-green-500"></span>{{ __('Connected') }}
                        </span>
                    @elseif($organization->allocore_hub_url)
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-300">
                            <span class="size-2 rounded-full bg-amber-500"></span>{{ __('Pending') }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">
                            <span class="size-2 rounded-full bg-slate-400"></span>{{ __('Not connected') }}
                        </span>
                    @endif
                </div>

                @if($testStatus)
                    <div class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                        {{ $testStatus === 'success'
                            ? 'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300'
                            : 'bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300' }}">
                        <span class="material-symbols-outlined {{ $testStatus === 'success' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $testStatus === 'success' ? 'check_circle' : 'error' }}
                        </span>
                        {{ $testMessage }}
                    </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('Hub URL') }}
                            <span class="text-red-500">*</span></label>
                        <input wire:model="hubUrl" type="url" placeholder="https://hub.allocore.de"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary/30 focus:border-primary text-sm outline-none transition-all" />
                        @error('hubUrl') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('API Key') }}
                            <span class="text-red-500">*</span></label>
                        <input wire:model="apiKey" type="text" placeholder="alc_..."
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary/30 focus:border-primary text-sm outline-none transition-all font-mono" />
                        @error('apiKey') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-slate-400">
                            {{ __('Generate this on the hub: Tools → connect AuditPro → copy the key (shown once).') }}
                        </p>
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer select-none">
                        <input wire:model="enabled" type="checkbox"
                            class="rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary/30" />
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                            {{ __('Push audit results to the hub') }}
                        </span>
                    </label>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-sm hover:bg-primary/90 transition-all cursor-pointer">
                            {{ __('Save Connection') }}
                        </button>
                        <button type="button" wire:click="testConnection"
                            class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                            {{ __('Test Connection') }}
                        </button>
                        @if($organization->allocore_hub_url)
                            <button type="button" wire:click="disconnect"
                                wire:confirm="{{ __('Disconnect this organization from the AlloCore Hub?') }}"
                                class="px-5 py-2.5 rounded-xl border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 font-bold text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors cursor-pointer">
                                {{ __('Disconnect') }}
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Info panel -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 space-y-4">
                <h3 class="text-lg font-bold">{{ __('How it works') }}</h3>
                <ol class="space-y-3 text-sm text-slate-600 dark:text-slate-400 list-decimal list-inside">
                    <li>{{ __('Register on your AlloCore Hub — this creates your company.') }}</li>
                    <li>{{ __('Open Tools on the hub and connect AuditPro to get an API key.') }}</li>
                    <li>{{ __('Paste the hub URL and API key here, then save.') }}</li>
                    <li>{{ __('Every completed audit pushes its 5 pillars + Enterprise Readiness to the hub.') }}</li>
                </ol>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 text-sm">
                    <p class="text-slate-500 dark:text-slate-400">{{ __('Organization') }}</p>
                    <p class="font-semibold">{{ $organization->name }}</p>
                    @if($organization->allocore_last_synced_at)
                        <p class="text-slate-500 dark:text-slate-400 mt-2">{{ __('Last synced') }}</p>
                        <p class="font-semibold">{{ $organization->allocore_last_synced_at->diffForHumans() }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
