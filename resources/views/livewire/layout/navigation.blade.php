<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    /**
     * Change the application language.
     */
    public function changeLanguage($locale): void
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
    }
}; ?>
<nav x-data="{ open: false, languageOpen: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('wallet') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('wallet')" :active="request()->routeIs('wallet')" wire:navigate>
                        {{ __('wallet') }}
                    </x-nav-link>
                    <x-nav-link :href="route('withdraw')" :active="request()->routeIs('withdraw')" wire:navigate>
                        {{ __('withdraw') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Controls -->
            <div class="flex items-center gap-4">
                <!-- Language Selector -->
                <div class="relative" x-data="{ currentLanguage: '{{ session()->get('locale') }}' }">
                    <button @click="languageOpen = !languageOpen"
                        class="flex items-center gap-1 text-gray-600 hover:text-gray-900 transition-colors"
                        x-text="currentLanguage === 'en' ? '{{ __('en') }}' : '{{ __('kh') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 5a1 1 0 100 2h1a2 2 0 011.732 1H7a1 1 0 100 2h2.732A2 2 0 018 11H7a1 1 0 00-.707 1.707l3 3a1 1 0 001.414-1.414l-1.483-1.484A4.008 4.008 0 0011.874 10H13a1 1 0 100-2h-1.126a3.976 3.976 0 00-.41-1H13a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Language Dropdown -->
                    <div x-show="languageOpen" @click.away="languageOpen = false"
                        class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                        style="display: none">
                        <a wire:navigate href="{{ route('local', ['locale' => 'en']) }}"
                            @click="currentLanguage = 'en'; languageOpen = false"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2"
                            :class="{ 'bg-gray-50 font-medium': currentLanguage === 'en' }">
                            <span class="fi fi-us"></span>
                            {{ __('english') }}
                        </a>
                        <a wire:navigate href="{{ route('local', ['locale' => 'kh']) }}"
                            @click="currentLanguage = 'kh'; languageOpen = false"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2"
                            :class="{ 'bg-gray-50 font-medium': currentLanguage === 'kh' }">
                            <span class="fi fi-kh"></span>
                            {{ __('khmer') }}
                        </a>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"></div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('wallet')" :active="request()->routeIs('wallet')" wire:navigate>
                {{ __('wallet') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('withdraw')" :active="request()->routeIs('withdraw')" wire:navigate>
                {{ __('withdraw') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Mobile Language Selector -->
                <div class="px-4 py-2">
                    <div class="text-sm font-medium text-gray-500 mb-1">{{ __('Language') }}</div>
                    <div class="flex gap-2">
                        <button wire:click="changeLanguage('en')"
                            class="px-3 py-1 text-sm rounded border border-gray-200 hover:bg-gray-100">
                            English
                        </button>
                        <button wire:click="changeLanguage('kh')"
                            class="px-3 py-1 text-sm rounded border border-gray-200 hover:bg-gray-100">
                            ភាសាខ្មែរ
                        </button>
                    </div>
                </div>

                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
