<x-adminlayout>
    <h1>Edit Admin</h1>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Edit Admin</h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mt-4">
                    <label for="email" class="block text-md font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('email')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Field -->
                <div class="mt-4">
                    <label for="password" class="block text-md font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('password')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</ p>
                    @enderror

                <!-- Status Field -->
                <div class="mt-4">
                    <label for="status" class="block text-md font-medium text-gray-700">Status</label>
                    <select id="status" name="status"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        <option value="active" {{ old('status', $admin->status) === 'active' ? 'selected' : '' }}>Active
                        </option>
                        <option value="inactive" {{ old('status', $admin->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Roles Dropdown -->
                <div class="mt-4">
                    <label for="role" class="block text-md font-medium text-gray-700">Role</label>
                    <select id="role" name="role"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role', $admin->role->first()?->id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.admins.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg shadow-md hover:bg-violet-700 transition duration-200">
                        Update Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-adminlayout>a