@php
    $locales = [
        'en' => ['flag' => '🇺🇸', 'name' => 'English'],
        'de' => ['flag' => '🇩🇪', 'name' => 'Deutsch'],
        'es' => ['flag' => '🇪🇸', 'name' => 'Español'],
        'fr' => ['flag' => '🇫🇷', 'name' => 'Français'],
        'it' => ['flag' => '🇮🇹', 'name' => 'Italiano'],
        'pt' => ['flag' => '🇵🇹', 'name' => 'Português'],
        'nl' => ['flag' => '🇳🇱', 'name' => 'Nederlands'],
        'ar' => ['flag' => '🇸🇦', 'name' => 'العربية'],
        'zh' => ['flag' => '🇨🇳', 'name' => '中文'],
        'ja' => ['flag' => '🇯🇵', 'name' => '日本語'],
    ];
    $currentLocale = app()->getLocale();
    if (!array_key_exists($currentLocale, $locales)) {
        $currentLocale = 'en';
    }
@endphp

<div class="relative items-center z-50" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <button @click="open = !open" type="button"
        class="flex items-center gap-2 px-3 py-2 text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors bg-slate-100/50 dark:bg-slate-800/50 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-700">
        <span>{{ $locales[$currentLocale]['flag'] }}</span>
        <span class="uppercase">{{ $currentLocale }}</span>
        <span class="material-symbols-outlined text-[16px] transition-transform duration-200"
            :class="{'rotate-180': open}">expand_more</span>
    </button>

    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" style="display: none;"
        class="absolute right-0 mt-2 w-48 rounded-xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] dark:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.5)] bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-2 origin-top-right ring-1 ring-black ring-opacity-5 focus:outline-none">

        @foreach($locales as $code => $locale)
            <a href="{{ route('language.switch', $code) }}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors {{ $code === $currentLocale ? 'bg-primary/5 text-primary font-bold' : 'text-slate-700 dark:text-slate-300' }}">
                <span class="text-lg">{{ $locale['flag'] }}</span>
                <span class="text-sm">{{ $locale['name'] }}</span>
                @if($code === $currentLocale)
                    <span class="material-symbols-outlined text-[16px] ml-auto">check</span>
                @endif
            </a>
        @endforeach
    </div>
</div>