<x-adminlayout>
    <h1>add permission</h1>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Add Permission</h2>
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
                <!-- Permission Name -->
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Permission Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug Field -->
                <div class="mt-4">
                    <label for="slug" class="text-md font-medium text-gray-700">Slug</label>
                    <input type="text" id="slug" name="slug"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    @error('slug')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-4">
                    <a href="{{ route('admin.permission') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg shadow-md hover:bg-violet-700 transition duration-200">
                        Add Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-adminlayout>

<!-- Vanilla JavaScript for Slug Generation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('input', function () {
            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')   // Replace non-alphanumeric with dashes
                .replace(/^-+|-+$/g, '');      // Trim starting and ending dashes
            slugInput.value = slug;
        });
    });
</script>
