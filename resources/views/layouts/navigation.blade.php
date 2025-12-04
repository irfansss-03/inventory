<nav x-data="{ open: false }" class="glass-card border-b border-gray-300 dark:border-white/10 sticky top-0 z-50 hover-lift">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo with glow effect -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('dashboard') }}" class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg blur-lg opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <div class="relative bg-gradient-to-r from-blue-500 to-purple-600 p-2 rounded-lg">
                            <x-application-logo class="block h-9 w-auto fill-current text-white transform group-hover:scale-110 transition duration-300" />
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('dashboard') ? 'border-blue-400 text-gray-900 dark:text-white' : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-300' }}">
                        <i class="fas fa-chart-line mr-2"></i>{{ __('Dashboard') }}
                    </x-nav-link>
                    @auth
                        @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                            <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('barang.index') ? 'border-green-400 text-gray-900 dark:text-white' : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-300' }}">
                                <i class="fas fa-boxes mr-2"></i>{{ __('Manajemen Barang') }}
                            </x-nav-link>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('karyawan.index')" :active="request()->routeIs('karyawan.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('karyawan.index') ? 'border-purple-400 text-gray-900 dark:text-white' : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-300' }}">
                                <i class="fas fa-users mr-2"></i>{{ __('Manajemen Karyawan') }}
                            </x-nav-link>
                            <x-nav-link :href="route('activity-log.index')" :active="request()->routeIs('activity-log.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('activity-log.index') ? 'border-orange-400 text-gray-900 dark:text-white' : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-300' }}">
                                <i class="fas fa-history mr-2"></i>{{ __('Log Aktivitas') }}
                            </x-nav-link>
                            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-300 {{ request()->routeIs('users.*') ? 'border-pink-400 text-gray-900 dark:text-white' : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-300' }}">
                                <i class="fas fa-user-cog mr-2"></i>{{ __('Manage User') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                <!-- Theme Toggle Button -->
                <div
                    x-data="{
                        theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
                        toggle() {
                            this.theme = this.theme === 'light' ? 'dark' : 'light';
                            localStorage.setItem('theme', this.theme);
                            document.documentElement.classList.toggle('dark', this.theme === 'dark');
                        }
                    }"
                    x-init="document.documentElement.classList.toggle('dark', theme === 'dark')"
                >
                    <button @click="toggle()" class="relative p-2.5 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white bg-gray-100 dark:bg-white/5 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-110 group">
                        <svg x-show="theme !== 'dark'" class="h-5 w-5 transition-transform duration-500 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="theme === 'dark'" class="h-5 w-5 transition-transform duration-500 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm leading-4 font-medium rounded-xl text-gray-900 dark:text-white bg-gray-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 hover:text-white backdrop-blur-sm border border-gray-300 dark:border-white/20 focus:outline-none transition-all ease-in-out duration-300 transform hover:scale-105">
                                <i class="fas fa-user-circle mr-2 text-lg"></i>
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="glass-card border border-gray-300 dark:border-white/10 rounded-lg overflow-hidden">
                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-blue-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                                    <i class="fas fa-user-edit mr-3"></i>{{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-red-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                                        <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/10 focus:outline-none transition-all duration-300 transform hover:scale-110">
                    <svg class="h-6 w-6 transition-transform duration-300" :class="{'rotate-90': open}" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="pt-2 pb-3 space-y-1 bg-gray-50/90 dark:bg-black/20 backdrop-blur-xl border-t border-gray-300 dark:border-white/10">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-blue-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                <i class="fas fa-chart-line mr-3"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                    <x-responsive-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')"
                        class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-green-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <i class="fas fa-boxes mr-3"></i>{{ __('Manajemen Barang') }}
                    </x-responsive-nav-link>
                @endif
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('karyawan.index')" :active="request()->routeIs('karyawan.index')"
                        class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-purple-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <i class="fas fa-users mr-3"></i>{{ __('Manajemen Karyawan') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('activity-log.index')" :active="request()->routeIs('activity-log.index')"
                        class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-orange-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <i class="fas fa-history mr-3"></i>{{ __('Log Aktivitas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                        class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-pink-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <i class="fas fa-user-cog mr-3"></i>{{ __('Manage User') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-300 dark:border-white/10 bg-gray-50/90 dark:bg-black/20 backdrop-blur-xl">
            <div class="px-4">
                <div class="font-medium text-base text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-user-circle mr-2 text-blue-500 dark:text-blue-400"></i>{{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-600 dark:text-gray-400 ml-6">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-blue-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                    <i class="fas fa-user-edit mr-3"></i>{{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:bg-red-500/20 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>