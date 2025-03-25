<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/toasty.js@1.0.1/dist/toasty.min.js"></script>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-black text-white min-h-screen fixed">
            <nav class="p-6">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.products') ? 'bg-gray-800' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.orders') ? 'bg-gray-800' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.customers') ? 'bg-gray-800' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Customers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.static-blocks.index') }}" 
                           class="flex items-center py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.static-blocks.*') ? 'bg-gray-800' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            Static Blocks
                        </a>
                    </li>
                </ul>

                <!-- Logout Button -->
                <div class="absolute bottom-0 left-0 w-full p-6">
                    <form method="get" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center py-2 px-4 bg-red-600 hover:bg-red-700 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white shadow-md">
                <div class="flex justify-between items-center p-4">
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $title ?? 'Admin Dashboard' }}</h1>
                </div>
            </header>
          
            <!-- Main Content Area -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        @if(Session::has('success'))
            Toastify({
                text: "{{ Session::get('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#10B981",
                className: "rounded-lg",
            }).showToast();
        @endif

        @if(Session::has('error'))
            Toastify({
                text: "{{ Session::get('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#EF4444",
                className: "rounded-lg",
            }).showToast();
        @endif
    </script>
</body>
</html>