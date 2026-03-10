<x-app-layout>
    <!-- Welcome Section -->
    <div class="flex flex-col lg:flex-row justify-between lg:items-end gap-6 mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight mb-2">{{ __('Welcome back,') }}
                {{ explode(' ', Auth::user()->name)[0] }}
            </h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-lg text-sm sm:text-base">
                {{ __('Monitor your business growth and maturity scores across your portfolio.') }}
                {{ __('You have :count pending audits to review.', ['count' => $audits->where('status', 'in_progress')->count()]) }}
            </p>
        </div>
        <div
            class="bg-primary/5 border border-primary/10 rounded-xl p-4 flex items-center justify-between sm:justify-start gap-4 w-full lg:w-auto">
            <div class="text-primary">
                <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wider">{{ __('Average Maturity') }}</p>
                <p class="text-xl sm:text-2xl font-black">
                    {{ number_format($audits->where('status', 'completed')->avg(function ($audit) {
    return $audit->results->avg('average_score') * 20; }) ?: 0, 1) }}%
                </p>
            </div>
            <div class="w-px h-10 bg-primary/20"></div>
            <div class="text-slate-500 dark:text-slate-400">
                <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wider">{{ __('Active Audits') }}</p>
                <p class="text-xl sm:text-2xl font-black text-slate-700 dark:text-slate-200">
                    {{ $audits->where('status', 'in_progress')->count() }}
                </p>
            </div>
        </div>
    </div>

    <!-- Audit History Table -->
    <section>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">{{ __('Recent Audit History') }}</h3>
        </div>
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-x-auto w-full">
            <table class="w-full text-left min-w-[500px]">
                <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ __('Company Name') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ __('Status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                            {{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($audits as $audit)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                        {{ substr($audit->organization->name ?? 'NA', 0, 2) }}
                                    </div>
                                    <span class="font-medium">{{ $audit->organization->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($audit->status == 'completed')
                                    <span
                                        class="text-xs bg-green-100 dark:bg-green-900/30 px-2.5 py-1 rounded-full text-green-600 dark:text-green-300">{{ __('Completed') }}</span>
                                @else
                                    <span
                                        class="text-xs bg-yellow-100 dark:bg-yellow-900/30 px-2.5 py-1 rounded-full text-yellow-600 dark:text-yellow-300">{{ __('In Progress') }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if($audit->status == 'in_progress')
                                    <a href="{{ route('audit.assessment', $audit) }}"
                                        class="text-primary hover:text-primary/80 font-bold text-sm">{{ __('Resume') }}</a>
                                @else
                                    <a href="{{ route('audit.results', $audit) }}"
                                        class="text-primary hover:text-primary/80 font-bold text-sm">{{ __('View Details') }}</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-500">
                                {{ __('No audits found. Create one.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>