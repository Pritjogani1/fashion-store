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
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-black text-white min-h-screen">
            {{ $sidebar ?? '' }}
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Dashboard</a></li>
                    <li><a href="{{ route('admin.products') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Products</a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Categories</a></li>
                    <li><a href="{{ route('admin.customers') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Customers</a></li>
                    <li><a href="{{ route('admin.logout') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Logout</a></li>
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