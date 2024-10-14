<div class="bg-black w-64 min-h-screen flex-shrink-0 border-r border-gray-800">
    <div class="flex flex-col h-full">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <nav class="mt-5 flex-1 px-2 space-y-1">
                <a href="{{ route('dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-white hover:bg-red-700 hover:text-white">
                    <!-- Heroicon name: outline/home -->
                    <svg class="mr-3 flex-shrink-0 h-6 w-6 text-white group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-white hover:bg-red-700 hover:text-white">
                    <!-- Heroicon name: outline/shopping-bag -->
                    <svg class="mr-3 flex-shrink-0 h-6 w-6 text-white group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Product
                </a>
                <a href="{{ route('categories.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-white hover:bg-red-700 hover:text-white">
                    <!-- Heroicon name: outline/folder -->
                    <svg class="mr-3 flex-shrink-0 h-6 w-6 text-white group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    Categories
                </a>
                <a href="{{ route('reviews.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-white hover:bg-red-700 hover:text-white">
                    <!-- Heroicon name: outline/star -->
                    <svg class="mr-3 flex-shrink-0 h-6 w-6 text-white group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    Review
                </a>
                <a href="{{ route('wishlist.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-white hover:bg-red-700 hover:text-white">
                    <!-- Heroicon name: outline/heart -->
                    <svg class="mr-3 flex-shrink-0 h-6 w-6 text-white group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Wishlist
                </a>
                <!-- Tambahkan item-item sidebar lainnya di sini jika diperlukan -->
            </nav>
        </div>
    </div>
</div>