<x-adminlayout>
    <h1>Add Role</h1>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Add Role</h2>
            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Role Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs textd-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 space-y-2">
                    <label for="name" class="block text-md font-medium text-gray-700" >Role Name</label>
                    <label class="inline-flex items-center block"></label>
                     
                    <input type="hidden" name="is_super_admin" value="no">
                    <input type="checkbox" name="is_super_admin" value="yes"
                           {{ old('is_super_admin') == 'yes' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-violet-500 focus:ring-violet-500">
                    <span class="ml-2 text-md text-gray-700">Is Super Admin</span>
                    
                    @foreach($permissions as $permission)
                        <label class="inline-flex items-center block">
                            <input type="checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}"
                                   class="rounded border-gray-300 text-violet-500 focus:ring-violet-500">
                            <span class="ml-2 text-md text-gray-700">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <a href="{{ route('admin.role') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg shadow-md hover:bg-violet-700 transition duration-200">
                        Add Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-adminlayout>