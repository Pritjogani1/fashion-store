<x-adminlayout>
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold">Categories</h2>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="name" class="w-full p-3 border rounded-lg" placeholder="Category Name" required>
                    </div>
                    <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-white hover:text-black">
                        Add Category
                    </button>
                </div>
            </form>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="border-b">
                        <td class="p-3">{{ $category->id }}</td>
                        <td class="p-3">{{ $category->name }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-red-600" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-adminlayout>