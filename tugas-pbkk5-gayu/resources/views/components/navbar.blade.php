<nav x-data="{ open: false, cartOpen: false }" class="bg-black">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-auto" src="{{ asset('img/catharsisnew.png') }}" alt="Logo">
                </div>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('dashboard') }}" class="border-red-900 text-white hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Catharsis Empire
                    </a>
                    <!-- Tambahkan menu lainnya di sini -->
                </div>
            </div>
            
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                <!-- Cart Icon with Item Count -->
                <div class="relative">
                    <button @click="cartOpen = true" class="text-white hover:text-gray-300 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full h-5 w-5 flex items-center justify-center text-xs">
                            {{ Auth::user()->cartItemsCount() }}
                        </span>
                    </button>
                </div>
                
                <!-- Contact Us Icon -->
                <a href="{{ route('contact') }}" class="text-white hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </a>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('orders.index')">
                            {{ __('My Orders') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Products') }}
            </x-responsive-nav-link>
            <!-- Add more responsive menu items as needed -->
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.index')">
                    {{ __('My Orders') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div x-show="cartOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-full"
         class="fixed inset-y-0 right-0 max-w-xs w-full bg-black shadow-xl z-50 overflow-y-auto"
         @click.away="cartOpen = false">
        <div class="p-6 text-white h-full flex flex-col">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-semibold">CART</h2>
                <button @click="cartOpen = false" class="text-white hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-grow overflow-y-auto">
                @if(Auth::user()->cart && Auth::user()->cart->items->count() > 0)
                    @foreach(Auth::user()->cart->items as $item)
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-sm font-medium">{{ $item->product->name }}</h3>
                                <p class="text-xs text-gray-400">Size: {{ $item->size }}, Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="text-sm">Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm mb-auto">Your cart is empty.</p>
                @endif
            </div>
            <div class="mt-8">
                @if(Auth::user()->cart && Auth::user()->cart->items->count() > 0)
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-semibold">Total:</span>
                        <span class="font-semibold">Rp{{ number_format(Auth::user()->cart->total(), 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('cart.checkout') }}" class="bg-white text-black px-6 py-3 rounded-full hover:bg-gray-200 flex items-center justify-center w-full mb-4">
                        CHECKOUT
                    </a>
                @endif
                <button @click="cartOpen = false" class="border border-white text-white px-6 py-3 rounded-full hover:bg-white hover:text-black transition-colors duration-300 flex items-center justify-center w-full">
                    CONTINUE BROWSING
                </button>
            </div>
        </div>
    </div>
</nav>