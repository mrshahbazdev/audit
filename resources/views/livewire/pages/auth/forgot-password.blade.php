<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div
    class="relative flex min-h-screen w-full flex-col bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-950 overflow-x-hidden">
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
                <div class="flex flex-col gap-2 mb-6 text-center">
                    <h1 class="text-slate-900 dark:text-slate-100 text-3xl font-black tracking-tight">
                        {{ __('Forgot Password') }}</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-normal">
                        {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="sendPasswordResetLink" class="space-y-5">
                    <!-- Email Address -->
                    <div class="flex flex-col gap-2">
                        <label
                            class="text-slate-700 dark:text-slate-300 text-sm font-semibold">{{ __('Email Address') }}</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                            <input wire:model="email"
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                type="email" required autofocus placeholder="name@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <button
                            class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/25 transition-all active:scale-[0.98] flex items-center justify-center gap-2"
                            type="submit">
                            <span>{{ __('Email Password Reset Link') }}</span>
                            <span class="material-symbols-outlined text-[18px]">send</span>
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                    <p class="text-slate-500 dark:text-slate-400 text-sm">
                        {{ __('Remember your password?') }}
                        <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}"
                            wire:navigate>{{ __('Back to login') }}</a>
                    </p>
                </div>
            </div>
        </main>

        <footer class="p-6 text-center text-slate-400 dark:text-slate-500 text-xs relative z-10">
            © {{ date('Y') }} {{ config('app.name', 'AuditPro') }}. {{ __('All rights reserved.') }}
        </footer>

        <!-- Decorative Background Elements -->
        <div class="fixed top-0 right-0 -z-10 w-1/3 h-1/3 bg-primary/5 blur-[120px] rounded-full pointer-events-none">
        </div>
        <div
            class="fixed bottom-0 left-0 -z-10 w-1/4 h-1/4 bg-primary/10 blur-[100px] rounded-full pointer-events-none">
        </div>
    </div>
</div>