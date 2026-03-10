<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div
    class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-950">
    <div class="layout-container flex h-full grow flex-col">
        <header
            class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200/50 dark:border-slate-800/50 px-6 md:px-10 py-4 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md">
            <div class="flex items-center gap-4">
                <a href="/"
                    class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary transition-all border border-primary/20">
                    <span class="material-symbols-outlined text-2xl block">analytics</span>
                </a>
                <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold leading-tight tracking-tight">
                    Audit<span class="text-primary">Pro</span></h2>
            </div>
        </header>
        <main class="flex-1 flex items-center justify-center p-4 relative z-10">
            <div
                class="w-full max-w-[480px] bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex flex-col gap-2 mb-8 text-center">
                    <h1 class="text-slate-900 dark:text-slate-100 text-3xl font-black tracking-tight">
                        {{ __('Welcome Back') }}</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-base font-normal">
                        {{ __('Login to manage your audits') }}</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="login" class="space-y-5">
                    <div class="flex flex-col gap-2">
                        <label
                            class="text-slate-700 dark:text-slate-300 text-sm font-semibold">{{ __('Email Address') }}</label>
                        <input wire:model="form.email"
                            class="form-input block w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary h-12 px-4 placeholder:text-slate-400"
                            placeholder="name@example.com" required type="email" autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                    </div>

                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center">
                            <label
                                class="text-slate-700 dark:text-slate-300 text-sm font-semibold">{{ __('Password') }}</label>
                            @if (Route::has('password.request'))
                                <a class="text-primary text-xs font-semibold hover:underline"
                                    href="{{ route('password.request') }}" wire:navigate>{{ __('Forgot password?') }}</a>
                            @endif
                        </div>
                        <div class="relative flex items-stretch">
                            <input wire:model="form.password"
                                class="form-input block w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary h-12 pl-4 pr-12 placeholder:text-slate-400"
                                placeholder="••••••••" required type="password" autocomplete="current-password" />
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-2 py-2">
                        <input wire:model="form.remember"
                            class="rounded border-slate-300 dark:border-slate-700 text-primary focus:ring-primary bg-white dark:bg-slate-800"
                            id="remember" type="checkbox" />
                        <label class="text-sm text-slate-600 dark:text-slate-400"
                            for="remember">{{ __('Remember me') }}</label>
                    </div>

                    <button
                        class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg shadow-md transition-all flex items-center justify-center gap-2"
                        type="submit">
                        <span>{{ __('Sign In') }}</span>
                        <span class="material-symbols-outlined text-[18px]">login</span>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                    <p class="text-slate-500 dark:text-slate-400 text-sm">
                        {{ __('New here?') }}
                        <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register') }}"
                            wire:navigate>{{ __('Create an account') }}</a>
                    </p>
                </div>
            </div>
        </main>
        <footer class="p-6 text-center text-slate-400 dark:text-slate-500 text-xs relative z-10">
            © {{ date('Y') }} {{ __('AuditPro SaaS. All rights reserved.') }}
        </footer>
        <div class="fixed top-0 right-0 -z-10 w-1/3 h-1/3 bg-primary/5 blur-[120px] rounded-full"></div>
        <div class="fixed bottom-0 left-0 -z-10 w-1/4 h-1/4 bg-primary/10 blur-[100px] rounded-full"></div>
    </div>
</div>