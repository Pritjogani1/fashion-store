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
        <aside class="w-64 bg-black text-white min-h-screen">
            {{ $sidebar ?? '' }}
            <nav class="bg-gray-800 text-white w-64 p-6">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold">Admin Panel</h1>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.products') ? 'bg-gray-700' : '' }}">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.orders') ? 'bg-gray-700' : '' }}">
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers') }}" class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.customers') ? 'bg-gray-700' : '' }}">
                            Customers
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow">
                {{ $header ?? '' }}
                <div class="p-4">
                    <h1 class="text-2xl font-semibold">Admin Panel</h1>
                </div>
            </header>
          
            <!-- Main Content Area -->
            <main class="flex-1 bg-gray-100 p-6">
                {{ $slot }}
<script>
    @if(Session::has('success'))
        Toastify({
            text: "{{ Session::get('success') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "green",
        }).showToast();
    @endif

    @if(Session::has('error'))
        Toastify({
            text: "{{ Session::get('error') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
    @endif
</script>
            </main>

        </div>
    </div>
</body>
</html>