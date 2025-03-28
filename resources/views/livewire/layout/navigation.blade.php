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
}; ?>
<nav x-data="{ open: false, languageOpen: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('wallet') }}" wire:navigate class="transition hover:opacity-75">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
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
            <div class="flex items-center gap-2">
                <!-- Language Selector -->
                <div class="relative" x-data="{ currentLanguage: '{{ session()->get('locale') }}' }">
                    <button @click="languageOpen = !languageOpen"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                        <span x-show="currentLanguage === 'en'" class="fi fi-us rounded-sm"></span>
                        <span x-show="currentLanguage === 'kh'" class="fi fi-kh rounded-sm"></span>
                        <span x-text="currentLanguage === 'en' ? '{{ __('en') }}' : '{{ __('kh') }}'"
                            class="text-sm font-medium text-gray-700"></span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Language Dropdown -->
                    <div x-show="languageOpen" @click.away="languageOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-100"
                        style="display: none">
                        <a wire:navigate href="{{ route('local', ['locale' => 'en']) }}"
                            @click="currentLanguage = 'en'; languageOpen = false"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors"
                            :class="{ 'bg-blue-50 text-blue-600': currentLanguage === 'en' }">
                            <span class="fi fi-us rounded-sm"></span>
                            {{ __('english') }}
                            <svg x-show="currentLanguage === 'en'" class="w-4 h-4 ml-auto text-blue-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a wire:navigate href="{{ route('local', ['locale' => 'kh']) }}"
                            @click="currentLanguage = 'kh'; languageOpen = false"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors"
                            :class="{ 'bg-blue-50 text-blue-600': currentLanguage === 'kh' }">
                            <span class="fi fi-kh rounded-sm"></span>
                            {{ __('khmer') }}
                            <svg x-show="currentLanguage === 'kh'" class="w-4 h-4 ml-auto text-blue-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                                <div class="font-medium text-base text-gray-800 truncate max-w-[100px]" 
                    x-data="{{ json_encode(['name' => auth()->user()->name]) }}" 
                    x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name"></div>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="flex items-center gap-2 text-red-600 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('wallet')" :active="request()->routeIs('wallet')" wire:navigate
                class="flex items-center gap-2 px-4 py-2 text-base font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                {{ __('wallet') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('withdraw')" :active="request()->routeIs('withdraw')" wire:navigate
                class="flex items-center gap-2 px-4 py-2 text-base font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                {{ __('withdraw') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 py-3">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="flex items-center gap-2 text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
