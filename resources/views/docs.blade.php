<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Premium SEO Tags -->
    <title>{{ __('User Guide & Documentation | AuditPro Business Maturity Tool') }}</title>
    <meta name="description"
        content="{{ __('Complete user guide for AuditPro. Learn how to configure custom enterprise audit templates, use branching logic, weighting, and understand the Maturity Radar charts.') }}">
    <meta name="keywords"
        content="{{ __('AuditPro, Documentation, Business Maturity, Custom Audits, Radar Chart, Business Scaling') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social -->
    <meta property="og:title" content="{{ __('User Guide | AuditPro') }}">
    <meta property="og:description"
        content="{{ __('Learn how to configure custom enterprise audit templates, branching logic, and maturity radar charts.') }}">
    <meta property="og:type" content="website">

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
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-slate-950 font-display text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden pt-24">

    <!-- Navbar -->
    <header
        class="fixed w-full top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/50 dark:border-slate-800/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div
                        class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all border border-primary/20">
                        <span class="material-symbols-outlined text-2xl drop-shadow-sm">analytics</span>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Audit<span
                            class="text-primary">Pro</span></span>
                </a>

                <!-- Auth Navigation & Language -->
                <div class="flex items-center gap-4">
                    <x-language-switcher />
                    <a href="{{ url('/') }}"
                        class="text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors hidden sm:block">{{ __('Home') }}</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="flex items-center justify-center rounded-xl h-10 px-5 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/30 hover:shadow-xl hover:bg-primary/90 transition-all hover:-translate-y-0.5">{{ __('Go to Dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors">{{ __('Log in') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="hidden sm:flex items-center justify-center rounded-xl h-10 px-5 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/30 hover:shadow-xl hover:bg-primary/90 transition-all hover:-translate-y-0.5">
                                    {{ __('Get Started') }}
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12 text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary mb-4 text-xs font-bold uppercase tracking-widest border border-primary/20 shadow-sm">
                <span class="material-symbols-outlined text-[16px]">menu_book</span> {{ __('Documentation') }}
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">
                {{ __('AuditPro User Guide') }}</h1>
            <p class="text-xl text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                {{ __('Complete documentation on how to use the Enterprise Audit System to configure custom templates and analyze maturity bottlenecks.') }}
            </p>
        </div>

        <div class="space-y-10">
            <!-- 1. Overview -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-inner">
                            <span class="material-symbols-outlined text-[28px]">rocket_launch</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ __('1. Overview') }}</h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg">
                        <p>{!! __('Welcome to <strong>AuditPro</strong>, a powerful business maturity and evaluation platform. This tool allows your organization to build custom audit frameworks, assess various companies, and visualize performance gaps using intelligent scoring and conditional logic.') !!}
                        </p>
                    </div>
                </div>
            </section>

            <!-- 2. Dashboard -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500 shadow-inner">
                            <span class="material-symbols-outlined text-[28px]">dashboard</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ __('2. Dashboard') }}</h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg space-y-4">
                        <p>{{ __('The Dashboard is your main control center. Here you can see a high-level overview of your recent activity.') }}
                        </p>
                        <ul class="list-disc pl-5 space-y-2 marker:text-blue-500">
                            <li>{!! __('<strong>Recent Audits:</strong> Quickly access the latest completed or drafted audits.') !!}
                            </li>
                            <li>{!! __('<strong>Start Audit:</strong> The primary action button allows you to select a Company and a Template to begin a new evaluation.') !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- 3. Companies -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 shadow-inner">
                            <span class="material-symbols-outlined text-[28px]">domain</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ __('3. Companies') }}</h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg space-y-4">
                        <p>{{ __('The Companies tab allows you to manage the entities you will be auditing.') }}</p>
                        <ul class="list-disc pl-5 space-y-2 marker:text-emerald-500">
                            <li>{!! __('You can create a new company by clicking <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800 rounded font-semibold text-slate-700 dark:text-slate-200 text-sm">Add Company</span>.') !!}
                            </li>
                            <li>{{ __('Provide details like the industry, company size, and contact information.') }}
                            </li>
                            <li>{{ __('All audits must be associated with a specific company in your database.') }}</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- 4. Templates & Builder -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group border-t-4 border-t-purple-500">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-purple-500/5 rounded-bl-[200px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500/20 to-purple-600/10 flex items-center justify-center text-purple-600 dark:text-purple-400 shadow-inner border border-purple-500/20">
                            <span class="material-symbols-outlined text-[32px]">build</span>
                        </div>
                        <h2 class="text-3xl font-black tracking-tight">{{ __('4. Template Builder') }} <span
                                class="text-purple-500 text-lg align-middle bg-purple-100 dark:bg-purple-900/30 px-3 py-1 rounded-full ml-2 font-bold tracking-widest uppercase">{{ __('Advanced') }}</span>
                        </h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg space-y-6">
                        <p class="text-xl">
                            {{ __('The Template Builder is the core of the Enterprise system. It allows you to create completely custom assessment frameworks.') }}
                        </p>

                        <div
                            class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <h3
                                class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-purple-500 text-[20px]">account_tree</span>
                                {{ __('Pillars & Target Scores') }}
                            </h3>
                            <p>{!! __('Templates are divided into <strong>Pillars</strong> (categories). For each Pillar, you define a <strong>Target Score</strong> (e.g., 4.0 out of 5), which sets the benchmark that the company must reach. This benchmark is dynamically plotted onto the final Results Radar Chart.') !!}
                            </p>
                        </div>

                        <div
                            class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <h3
                                class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-3 flex items-center gap-2">
                                <span
                                    class="material-symbols-outlined text-purple-500 text-[20px]">format_list_bulleted</span>
                                {{ __('Question Types') }}
                            </h3>
                            <ul class="list-disc pl-5 space-y-2 marker:text-purple-400">
                                <li>{!! __('<strong>Scale 1-5:</strong> Standard rating scale (contributes to the final mathematical score).') !!}
                                </li>
                                <li>{!! __('<strong>Yes / No:</strong> Binary input (Yes = 5 points, No = 0 points).') !!}
                                </li>
                                <li>{!! __('<strong>Text Input:</strong> Freeform textual answer (ignored during scoring calculations).') !!}
                                </li>
                                <li>{!! __('<strong>File Upload:</strong> Allows auditors to upload evidence PDFs, Images, or Documents.') !!}
                                </li>
                                <li>{!! __('<strong>Dropdown Select:</strong> Choose a single option from a custom predefined list.') !!}
                                </li>
                                <li>{!! __('<strong>Multiple Checkboxes:</strong> Select multiple options from a custom predefined list.') !!}
                                </li>
                            </ul>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div
                                class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
                                <h3
                                    class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-3 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-purple-500 text-[20px]">balance</span>
                                    {{ __('Weights') }}
                                </h3>
                                <p>{!! __('Each question can be assigned a Weight multiplier (e.g., 1.5x) to make it more impactful on the final score. <em>Intelligent scoring calculates the true weighted average automatically.</em>') !!}
                                </p>
                            </div>
                            <div
                                class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
                                <h3
                                    class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-3 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-purple-500 text-[20px]">lightbulb</span>
                                    {{ __('Recommendations') }}
                                </h3>
                                <p>{{ __('You can provide specific advice. If the auditor scores a company below a 3/5 on a question, this exact advice will automatically appear on the final Results Dashboard.') }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-800/50">
                            <h3
                                class="text-xl font-bold text-indigo-900 dark:text-indigo-300 mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-indigo-500 text-[20px]">alt_route</span>
                                {{ __('Branching Logic & Routing') }}
                            </h3>
                            <p class="text-indigo-800 dark:text-indigo-200">
                                {!! __('You can create dynamic workflows! Under a question\'s settings, define a <strong>"Depends on Question"</strong> rule. The question will remain hidden until the designated parent question is answered with the specific <strong>"Triggering Answer"</strong> you define.') !!}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 5. Conducting Audits -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-500 shadow-inner">
                            <span class="material-symbols-outlined text-[28px]">assignment</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ __('5. Conducting Audits') }}</h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg space-y-4">
                        <p>{{ __('Navigate to the Dashboard or Companies tab to start a new Audit.') }}</p>
                        <ul class="list-disc pl-5 space-y-2 marker:text-amber-500">
                            <li>{{ __('Select the company and the specific custom template you created.') }}</li>
                            <li>{{ __('The assessment flows pillar by pillar, only revealing dynamically dependent questions as rules are met via the React/Livewire engine.') }}
                            </li>
                            <li>{{ __('You may safely leave the audit and return later; your progress is saved automatically.') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- 6. Results & Reports -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-rose-500/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl bg-rose-500/10 flex items-center justify-center text-rose-500 shadow-inner">
                            <span class="material-symbols-outlined text-[28px]">donut_small</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ __('6. Results & Reports') }}</h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg space-y-4">
                        <p>{{ __('Once an audit is finalized, the system computes the data based on weights and target scores.') }}
                        </p>
                        <ul class="list-disc pl-5 space-y-4 marker:text-rose-500">
                            <li class="pl-2">
                                {!! __('<strong>Maturity Radar Chart:</strong> Visualizes the actual performance (solid polygon) overlaid with the Template\'s Target Scores (dashed polygon) so you can easily identify gaps visually.') !!}
                            </li>
                            <li class="pl-2">
                                {!! __('<strong>Actionable Recommendations:</strong> Any poorly scored questions that had assigned failure advice in the Template Builder will be explicitly listed to the client as specific areas of improvement below the charts.') !!}
                            </li>
                            <li class="pl-2">
                                {!! __('<strong>PDF Export:</strong> Clicking <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800 rounded font-semibold text-slate-700 dark:text-slate-200 text-sm border border-slate-200 dark:border-slate-700">Download Report</span> will generate a beautifully formatted PDF containing the scores, charts, and recommendations.') !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- 7. Compare -->
            <section
                class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-500 shadow-inner">
                            <span class="material-symbols-outlined text-[28px]">compare_arrows</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ __('7. Compare Audits') }}</h2>
                    </div>
                    <div
                        class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-lg space-y-4">
                        <p>{{ __('The Compare Page lets you select two completed audits (typically for the same company over different periods, like Q1 vs Q3) and overlay their results directly.') }}
                        </p>
                        <ul class="list-disc pl-5 space-y-2 marker:text-indigo-500">
                            <li>{{ __('The Radar chart will combine both audit datasets transparently to visually demonstrate growth or regression.') }}
                            </li>
                            <li>{{ __('Pillar-by-pillar comparative tables show the exact point differences.') }}</li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-16 text-center border-t border-slate-200 dark:border-slate-800 pt-12 pb-8">
            <h3 class="text-2xl font-bold mb-4">{{ __('Ready to scale your auditing potential?') }}</h3>
            <a href="{{ route('register') }}"
                class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-primary text-white text-lg font-bold shadow-lg shadow-primary/30 hover:shadow-xl hover:bg-primary/90 transition-all hover:-translate-y-1">
                {{ __('Create an Account') }}
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
            <p class="mt-8 text-sm text-slate-500">© {{ date('Y') }} {{ __('AuditPro SaaS. All rights reserved.') }}</p>
        </div>
    </div>
    @livewireScripts
</body>

</html>