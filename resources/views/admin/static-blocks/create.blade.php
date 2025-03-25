<x-adminlayout>
    <main class="flex-1 p-6 bg-gray-50">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Create Static Block</h2>
            <p class="text-gray-600 mt-1">Add a new static content block</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('admin.static-blocks.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">slug</label>
                        <input type="text" name="slug" required
                               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-black focus:border-black"
                               placeholder="unique-identifier">
                    </div> --}}

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" required
                               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-black focus:border-black"
                               placeholder="Block Title">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea id="summernote" name="content"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex gap-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="1" checked
                                       class="rounded-full border-gray-300 text-black focus:ring-black">
                                <span class="ml-2">Active</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="0"
                                       class="rounded-full border-gray-300 text-black focus:ring-black">
                                <span class="ml-2">Inactive</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.static-blocks.index') }}" 
                           class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 {{ request()->routeIs('admin.static-blocks.index') ? 'bg-gray-800' : '' }}">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800">
                            Create Block
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Include Summernote CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Enter your content here...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
</x-adminlayout>