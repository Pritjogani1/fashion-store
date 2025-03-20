<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Admin Login</h2>
        <form  action="{{ route('admin.authenticate') }}" method="post" >
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 text-sm mb-2">Username</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your username" name="email" required>
            </div>
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <div class="mb-4">
                <label class="block text-gray-600 text-sm mb-2">Password</label>
                <input type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" name="password" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Login</button>
        </form>
    </div>
</body>
</html>
