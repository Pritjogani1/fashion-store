<x-adminlayout>
    <main class="flex-1 p-6">
        <h2 class="text-3xl font-semibold mb-6">Edit Customer</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.updateuser', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" 
                           class="w-full p-3 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="w-full p-3 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" 
                           class="w-full p-3 border rounded-lg">
                </div>

                <button type="submit" 
                        class="w-full bg-black text-white p-3 rounded-lg hover:bg-white hover:text-black">
                    Update Customer
                </button>
            </form>
        </div>
    </main>
</x-adminlayout>