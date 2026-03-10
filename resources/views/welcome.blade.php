<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AuditPro') }} - {{ __('Business Maturity Tool') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .hero-pattern {
            background-image: radial-gradient(#ec5b13 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.05;
        }

        .blob-1 {
            background: linear-gradient(to right, rgba(236, 91, 19, 0.4), rgba(255, 140, 80, 0.4));
            filter: blur(80px);
        }

        .blob-2 {
            background: linear-gradient(to right, rgba(255, 140, 80, 0.3), rgba(236, 91, 19, 0.3));
            filter: blur(80px);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-950 font-display text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden">

    <!-- Navbar -->
    <header
        class="fixed w-full top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/50 dark:border-slate-800/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div
                        class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all border border-primary/20">
                        <span class="material-symbols-outlined text-2xl">analytics</span>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Audit<span
                            class="text-primary">Pro</span></span>
                </div>

                <!-- Auth Navigation & Language -->
                <div class="flex items-center gap-4">
                    <x-language-switcher />
                    <a href="{{ route('docs') }}"
                        class="text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors hidden sm:block">{{ __('Docs') }}</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors">{{ __('Dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors">{{ __('Log in') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="flex items-center justify-center rounded-xl h-10 px-5 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/30 hover:shadow-xl hover:bg-primary/90 transition-all hover:-translate-y-0.5">
                                    {{ __('Get Started') }}
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 hero-pattern z-0"></div>
        <div
            class="absolute -top-40 -right-40 w-96 h-96 blob-1 rounded-full z-0 mix-blend-multiply dark:mix-blend-screen opacity-70">
        </div>
        <div
            class="absolute top-40 -left-20 w-[30rem] h-[30rem] blob-2 rounded-full z-0 mix-blend-multiply dark:mix-blend-screen opacity-50">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary border border-primary/20 text-sm font-bold mb-8 uppercase tracking-widest shadow-[0_0_20px_rgba(236,91,19,0.15)] backdrop-blur-sm">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                {{ __('Introducing Business Maturity Tool') }}
            </div>

            <h1
                class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white mb-8 tracking-tighter leading-[1.1]">
                {!! __('Scale your business with <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-[#ff8c50]">proven insights</span>') !!}
            </h1>

            <p class="mt-4 text-xl text-slate-600 dark:text-slate-400 mb-12 max-w-3xl mx-auto leading-relaxed">
                {!! __('Assess your business across 5 critical pillars: <span class="font-bold text-slate-800 dark:text-slate-200">Umsatz, Gewinn, Ordnung, Einfluss, and Vermächtnis.</span> Get a comprehensive maturity score and AI-driven action plan.') !!}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-primary text-white text-lg font-bold shadow-[0_10px_40px_-10px_rgba(236,91,19,0.8)] hover:shadow-[0_15px_50px_-10px_rgba(236,91,19,1)] transition-all hover:-translate-y-1">
                    {{ __('Start Free Audit') }}
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="#how-it-works"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-lg font-bold border border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all shadow-sm">
                    {{ __('How it works') }}
                </a>
            </div>
        </div>
    </section>

    <!-- UI Mockup Preview -->
    <section class="relative z-20 pb-20 -mt-10 px-4 sm:px-6 max-w-6xl mx-auto">
        <div
            class="rounded-2xl border border-slate-200/50 dark:border-slate-700/50 bg-white/40 dark:bg-slate-900/40 p-2 sm:p-4 backdrop-blur-2xl shadow-2xl overflow-hidden shadow-primary/10">
            <div
                class="rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white dark:bg-slate-900 flex flex-col md:flex-row h-auto md:h-[500px]">

                <!-- Left: Audit Stage -->
                <div
                    class="w-full md:w-1/2 p-6 md:p-10 border-b md:border-b-0 md:border-r border-slate-100 dark:border-slate-800 relative bg-slate-50 dark:bg-slate-900">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <span class="material-symbols-outlined text-9xl">analytics</span>
                    </div>
                    <div class="relative z-10">
                        <span
                            class="text-xs font-bold text-primary uppercase tracking-widest mb-2 block">{{ __('Pillar 1/5') }}</span>
                        <h3 class="text-3xl font-black mb-6">{{ __('Umsatz') }} <span
                                class="text-slate-400 font-medium">({{ __('Revenue') }})</span></h3>

                        <div class="space-y-4">
                            <div
                                class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm opacity-50">
                                <p class="text-sm font-bold mb-2">{{ __('1. Reliable Sales Process') }}</p>
                                <div class="flex gap-2">
                                    <div class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700"></div>
                                    <div class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700"></div>
                                    <div class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700"></div>
                                    <div
                                        class="h-8 w-8 rounded bg-primary/20 border border-primary text-primary flex items-center justify-center text-xs font-bold">
                                        4</div>
                                    <div class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700"></div>
                                </div>
                            </div>
                            <div
                                class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-primary shadow-[0_0_15px_rgba(236,91,19,0.1)] scale-105 origin-left transition-all">
                                <p class="text-sm font-bold mb-2">{{ __('2. Lead Diversification') }}</p>
                                <div class="flex gap-2 mb-2">
                                    <div
                                        class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 text-xs">
                                        1</div>
                                    <div
                                        class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 text-xs">
                                        2</div>
                                    <div
                                        class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 text-xs">
                                        3</div>
                                    <div
                                        class="h-8 w-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 text-xs">
                                        4</div>
                                    <div
                                        class="h-8 w-8 rounded bg-primary text-white flex items-center justify-center text-xs font-bold shadow-md">
                                        5</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Radar Chart Visualization -->
                <div
                    class="w-full md:w-1/2 p-6 md:p-10 flex flex-col items-center justify-center relative overflow-hidden bg-white dark:bg-slate-900 border-t border-slate-100/10">
                    <div
                        class="absolute -right-20 -top-20 w-64 h-64 bg-primary/5 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen">
                    </div>
                    <h4 class="font-bold text-slate-500 mb-8 uppercase tracking-widest text-sm z-10 w-full text-center">
                        {{ __('Final Result') }}
                    </h4>

                    <div class="relative w-64 h-64 z-10 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-18" viewBox="0 0 200 200">
                            <!-- Outer Pentagons -->
                            <polygon class="text-slate-100 dark:text-slate-800" fill="none"
                                points="100,20 176,75 147,165 53,165 24,75" stroke="currentColor" stroke-width="1">
                            </polygon>
                            <polygon class="text-slate-200 dark:text-slate-700" fill="none"
                                points="100,40 161,84 137,152 63,152 39,84" stroke="currentColor" stroke-width="1">
                            </polygon>
                            <polygon class="text-slate-100 dark:text-slate-800" fill="none"
                                points="100,60 146,93 128,139 72,139 54,93" stroke="currentColor" stroke-width="1">
                            </polygon>

                            <!-- Axes -->
                            <line class="text-slate-200 dark:text-slate-700" stroke="currentColor" x1="100" x2="100"
                                y1="100" y2="20"></line>
                            <line class="text-slate-200 dark:text-slate-700" stroke="currentColor" x1="100" x2="176"
                                y1="100" y2="75"></line>
                            <line class="text-slate-200 dark:text-slate-700" stroke="currentColor" x1="100" x2="147"
                                y1="100" y2="165"></line>
                            <line class="text-slate-200 dark:text-slate-700" stroke="currentColor" x1="100" x2="53"
                                y1="100" y2="165"></line>
                            <line class="text-slate-200 dark:text-slate-700" stroke="currentColor" x1="100" x2="24"
                                y1="100" y2="75"></line>

                            <!-- Data Area (Mocked values: 4, 2, 4.5, 3, 2) -->
                            <!-- Points: Ums(4)->64, Gew(2)->32, Ord(4.5)->72, Ein(3)->48, Ver(2)->32 -->
                            <polygon fill="rgba(236, 91, 19, 0.2)" points="100,36 130,90 142,158 72,138 65,90"
                                stroke="#ec5b13" stroke-width="3" stroke-linejoin="round"></polygon>
                        </svg>

                        <!-- Small score badge -->
                        <div class="absolute inset-0 m-auto flex items-center justify-center flex-col">
                            <span class="text-3xl font-black text-slate-800 dark:text-white">3.1</span>
                            <span class="text-[10px] uppercase font-bold text-primary">{{ __('Solid') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="how-it-works"
        class="py-24 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <h2 class="text-3xl font-black mb-4">{{ __('How It Works') }}</h2>
                <p class="text-slate-500 text-lg">
                    {{ __('A scientifically backed framework to analyze your business potential and find the bottlenecks preventing scaling.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="relative p-8 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:shadow-primary/5 transition-all group overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                    </div>
                    <div
                        class="w-14 h-14 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm flex items-center justify-center text-primary mb-6 relative z-10">
                        <span class="material-symbols-outlined text-2xl">checklist</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ __('1. Complete Assessment') }}</h3>
                    <p class="text-slate-500 leading-relaxed">
                        {{ __('Answer 25 targeted questions across our 5-pillar maturity framework. Evaluate your revenue, profit, structure, influence, and legacy.') }}
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="relative p-8 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:shadow-primary/5 transition-all group overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                    </div>
                    <div
                        class="w-14 h-14 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm flex items-center justify-center text-primary mb-6 relative z-10">
                        <span class="material-symbols-outlined text-2xl">donut_small</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ __('2. Visualize Results') }}</h3>
                    <p class="text-slate-500 leading-relaxed">
                        {{ __("Instantly view your company's strengths and weaknesses plotted on a clear, comparative radar chart with numerical maturity scores.") }}
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="relative p-8 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:shadow-xl hover:shadow-primary/5 transition-all group overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                    </div>
                    <div
                        class="w-14 h-14 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm flex items-center justify-center text-primary mb-6 relative z-10">
                        <span class="material-symbols-outlined text-2xl">insights</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ __('3. Actionable Insights') }}</h3>
                    <p class="text-slate-500 leading-relaxed">
                        {{ __('Get AI-driven recommendations highlighting which specific pillar to focus on first to dramatically increase your overall valuation.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-slate-900 border-t border-slate-800 text-center px-4 sm:px-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-primary/10"></div>
        <div
            class="absolute top-1/2 left-1/2 w-[800px] h-[800px] bg-primary/20 blur-[120px] rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <h2 class="text-4xl font-black text-white mb-6">{{ __('Stop guessing your trajectory.') }}</h2>
            <p class="text-xl text-slate-300 mb-10">
                {{ __('Join forward-thinking companies analyzing their true maturity level.') }}</p>
            <a href="{{ route('register') }}"
                class="inline-flex items-center justify-center gap-2 px-10 py-5 rounded-2xl bg-primary text-white text-lg font-bold shadow-[0_10px_40px_-5px_rgba(236,91,19,0.5)] hover:bg-white hover:text-primary transition-all hover:scale-105 active:scale-95 group">
                {{ __('Start Your Audit Now') }}
                <span
                    class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="size-6 bg-slate-800 rounded flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-sm">analytics</span>
                </div>
                <span class="font-bold text-white tracking-tight">AuditPro</span>
            </div>
            <p class="text-sm">© {{ date('Y') }} {{ __('AuditPro SaaS. All rights reserved.') }} <a
                    href="{{ route('docs') }}"
                    class="text-slate-500 hover:text-white transition-colors ml-4">{{ __('Documentation') }}</a></p>
        </div>
    </footer>

    @livewireScripts
</body>

</html>