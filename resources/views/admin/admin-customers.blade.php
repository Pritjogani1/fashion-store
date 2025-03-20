<x-adminlayout>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-4">Customer List</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                       
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Joined Date</th>
                        <th class="p-3 border">action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                         
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.edituser', $user->id) }}" 
                                   class="bg-black text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black mr-2">
                                    Edit
                                </a>
                                <form action="{{ route('admin.deleteuser', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-red-600"
                                            onclick="return confirm('Are you sure you want to delete this customer?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-adminlayout>