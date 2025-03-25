
<x-adminlayout>
    <main class="flex-1 p-6 bg-gray-50">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Static Blocks</h2>
                <p class="text-gray-600 mt-1">Manage your static content blocks</p>
            </div>
            <a href="{{ route('admin.static-blocks.create') }}" 
               class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.static-blocks.create') ? 'bg-gray-800' : '' }}">
                Create New Block
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">slug</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Title</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Status</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($blocks as $block)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $block->slug }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $block->title }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm {{ $block->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $block->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('admin.static-blocks.edit', $block) }}" 
                                           class="inline-flex items-center px-3 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.static-blocks.destroy', $block) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                                                    onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-adminlayout>