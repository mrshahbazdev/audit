<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $user_role = 'Buyer';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = $this->user_role;

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div
    class="relative flex min-h-screen w-full flex-col overflow-x-hidden bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-950">
    <div class="layout-container flex h-full grow flex-col">
        <div class="flex flex-1 justify-center py-10 px-4 relative z-10">
            <div
                class="layout-content-container flex flex-col max-w-[480px] w-full bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-slate-200/50 dark:border-slate-700/50">
                <header
                    class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-100 dark:border-slate-800 px-8 py-6">
                    <div class="flex items-center gap-3">
                        <a href="/"
                            class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary transition-all border border-primary/20">
                            <span class="material-symbols-outlined text-2xl block">analytics</span>
                        </a>
                        <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold leading-tight tracking-tight">
                            Audit<span class="text-primary">Pro</span></h2>
                    </div>
                </header>
                <div class="p-8">
                    <div class="mb-8">
                        <h1 class="text-slate-900 dark:text-slate-100 text-3xl font-extrabold tracking-tight">
                            {{ __('Create Account') }}</h1>
                        <p class="text-slate-500 dark:text-slate-400 mt-2">
                            {{ __('Join our community today and start exploring.') }}</p>
                    </div>

                    <form class="flex flex-col gap-5" wire:submit="register">
                        <!-- Role (Hidden, Default to Admin for now or derived from logic) -->
                        <input type="hidden" wire:model="user_role" value="Admin">

                        <!-- Full Name -->
                        <div class="flex flex-col gap-2">
                            <label
                                class="text-slate-700 dark:text-slate-300 text-sm font-medium">{{ __('Full Name') }}</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">person</span>
                                <input wire:model="name"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="John Doe" type="text" required autofocus autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col gap-2">
                            <label
                                class="text-slate-700 dark:text-slate-300 text-sm font-medium">{{ __('Email Address') }}</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                                <input wire:model="email"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="john@example.com" type="email" required autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="flex flex-col gap-2">
                            <label
                                class="text-slate-700 dark:text-slate-300 text-sm font-medium">{{ __('Password') }}</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                                <input wire:model="password"
                                    class="w-full pl-12 pr-12 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="••••••••" type="password" required autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="flex flex-col gap-2">
                            <label
                                class="text-slate-700 dark:text-slate-300 text-sm font-medium">{{ __('Confirm Password') }}</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">verified_user</span>
                                <input wire:model="password_confirmation"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="••••••••" type="password" required autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button
                            class="mt-4 w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/25 transition-all active:scale-[0.98]"
                            type="submit">
                            {{ __('Sign Up') }}
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-slate-500 dark:text-slate-400 text-sm">
                            {{ __('Already have an account?') }}
                            <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}"
                                wire:navigate>{{ __('Login') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed top-0 right-0 -z-10 w-1/3 h-1/3 bg-primary/5 blur-[120px] rounded-full"></div>
        <div class="fixed bottom-0 left-0 -z-10 w-1/4 h-1/4 bg-primary/10 blur-[100px] rounded-full"></div>
    </div>
</div>