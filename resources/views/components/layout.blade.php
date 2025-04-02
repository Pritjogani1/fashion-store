<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toasty.js@1.0.1/dist/toasty.min.css">

<!-- Add Toasty JS -->
<script src="https://cdn.jsdelivr.net/npm/toasty.js@1.0.1/dist/toasty.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])



    <style>
        :root {
            --primary-color: rgb(14, 15, 17); /* Coral Red - Fashionable and vibrant */
            --secondary-color:rgb(18, 22, 27); /* Dark Blue - Premium and elegant */
            --text-color: #ffffff; /* White for contrast */
        }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white">
    <nav class="bg-[var(--primary-color)] shadow-md position fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Left Side Logo -->
                <div class="flex items-center space-x-4">
                    <img src="{{Vite::asset('resources/images/logo.jpg')}}" alt="Logo" class="w-12 h-12 rounded-full border-2 border-white">
                    <span class="text-xl font-bold text-white">Fashion Store</span>
                </div>
                
                <!-- Centered Menu -->
                <div class="hidden md:flex space-x-8 mx-auto">
                    <x-nav-link href="/" :active="request()->is('/')" class="text-white hover:text-gray-200 font-semibold">Home</x-nav-link>
                    <x-nav-link href="/about" :active="request()->is('about')" class="text-white hover:text-gray-200 font-semibold">About</x-nav-link>
                    
                    <!-- Enhanced Products Dropdown -->
                    <!-- Replace the existing Products Dropdown section -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" 
                                class="flex items-center px-4 py-2 text-white font-semibold rounded-lg hover:bg-white hover:text-black transition-colors duration-200">
                            <span>Products</span>
                            <svg class="w-5 h-5 ml-2 transform transition-transform duration-200" 
                                 :class="{'rotate-180': open}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            @foreach($categories as $category)
                                <a href="{{ route('products.category', $category->slug) }}" 
                                   class="block px-4 py-3 text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200 first:rounded-t-lg last:rounded-b-lg">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $category->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
              <!-- Add this in your navigation bar -->
    <div class="relative">
        <input type="text" id="global-search-input" class="w-64 px-4 py-2 rounded-full border text-amber-50" placeholder="Search products...">
        <div id="global-search-results" class="absolute z-50 mt-2 w-full bg-white rounded-lg shadow-lg hidden"></div>
    </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Right Side Buttons -->
                <div class="hidden md:flex items-center space-x-6">
        @guest('user')
            <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
            <x-nav-link href="/login" :active="request()->is('login')" >Login</x-nav-link>
        @endguest
        @auth('user')
        <x-nav-link href="/logout" :active="request()->is('logout')" >Logout</x-nav-link>
                <x-nav-link href="/cart" :active="request()->is('cart')">Cart</x-nav-link>
                @endauth
                
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-[var(--primary-color)] shadow-md py-4  ">
       
        <a href="/" class="block px-4 py-2 text-white hover:bg-gray-200 hover:text-black pt-20">Home</a>
        <a href="/about" class="block px-4 py-2 text-white hover:bg-gray-200 hover:text-black ">About</a>
        <a href="/products" class="block px-4 py-2 text-white hover:bg-gray-200 hover:text-black ">Products</a>
        <a href="/login" class="block px-4 py-2 text-white hover:bg-gray-200 hover:text-bla<!-- ... existing nav code ... -->
<a href="{{ route('cart.show') }}" class="relative inline-block">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
        {{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : '0' }}
    </span>
</a>
<a href="/login" class="block px-4 py-2 text-white hover:bg-gray-200 hover:text-black pb-0">login</a>
        <a href="/logout" class="block px-4 py-2 text-white hover:bg-gray-200 hover:text-black pb-0">logout</a>
        
        
    </div>
    
    
    <div class="pt-20">
        {{$slot}}
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <!-- Add this in the head section -->
    <head>
        <style>
            .dropdown-menu {
                transform: scale(0);
                opacity: 0;
                transition: transform 0.2s, opacity 0.2s;
            }
            
            .dropdown-menu.active {
                transform: scale(1);
                opacity: 1;
            }
        </style>
    </head>
    
    <!-- Replace the Products Dropdown section -->
    <div class="relative">
        <button id="productBtn" class="px-4 py-2 text-white font-semibold rounded-lg hover:bg-white hover:text-black transition-colors duration-200 flex items-center space-x-2">
            <span>Products</span>
            <svg class="w-5 h-5 transition-transform duration-200" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div id="productMenu" class="dropdown-menu absolute w-56 bg-white rounded-lg shadow-xl">
            @foreach($categories as $category)
                <a href="{{ route('products.category', $category->slug) }}" 
                   class="block px-6 py-3 text-gray-800 hover:bg-gray-100 first:rounded-t-lg last:rounded-b-lg border-b border-gray-100 last:border-0">
                    <div class="flex items-center justify-between">
                        <span>{{ $category->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <!-- Add this script at the bottom of the body -->
    <script>
        // Existing menu button script...
    
        const productBtn = document.getElementById('productBtn');
        const productMenu = document.getElementById('productMenu');
        const dropdownArrow = document.getElementById('dropdownArrow');
    
        productBtn.addEventListener('click', () => {
            productMenu.classList.toggle('active');
            dropdownArrow.style.transform = productMenu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0)';
        });
    
        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!productBtn.contains(e.target) && !productMenu.contains(e.target)) {
                productMenu.classList.remove('active');
                dropdownArrow.style.transform = 'rotate(0)';
            }
        });
    </script>

  

    <!-- Add this before the closing </body> tag -->
  
</body>
</html>
