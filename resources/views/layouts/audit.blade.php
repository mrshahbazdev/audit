<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AuditPro') }} - {{ __('Assessment') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header
            class="sticky top-0 z-50 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-3">
                        <div class="bg-primary p-1.5 rounded-lg text-white">
                            <span class="material-symbols-outlined text-2xl block">analytics</span>
                        </div>
                        <h1 class="text-lg sm:text-xl font-bold tracking-tight hidden sm:block">{{ __('Business') }}
                            <span class="text-primary">{{ __('Maturity') }}</span> {{ __('Audit') }}</h1>
                        <h1 class="text-lg font-bold tracking-tight sm:hidden">AuditPro</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">dashboard</span>
                            <span class="text-sm font-semibold hidden sm:inline">{{ __('Dashboard') }}</span>
                        </a>
                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700"></div>
                        <button
                            class="size-10 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                            <span class="material-symbols-outlined">account_circle</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow max-w-5xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>

</html>