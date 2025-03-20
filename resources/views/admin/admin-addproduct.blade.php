<x-adminlayout>
    <main class="flex-1 p-6">
        <h2 class="text-3xl font-semibold mb-6">Add Product</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.addproduct') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Product Name</label>
                    <input type="text" class="w-full p-3 border rounded-lg" placeholder="Enter product name" name="name" id="productName">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Price</label>
                    <input type="text" class="w-full p-3 border rounded-lg" placeholder="Enter price" name="price">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Slug</label>
                    <input type="text" class="w-full p-3 border rounded-lg bg-gray-100" placeholder="Slug will auto-generate" name="slug" id="slug" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" >Photo</label>
                    <input type="file" class="w-full p-3 border rounded-lg" name="image">
                </div>
            
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Categories</label>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="categories[]" 
                                       value="{{ $category->id }}" 
                                       class="rounded border-gray-300"
                                       id="category_{{ $category->id }}">
                                <label for="category_{{ $category->id }}" class="ml-2">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Subcategory</label>
                    <select class="w-full p-3 border rounded-lg" name="sub_category">
                        <option value="">Select Subcategory</option>
                        <option value="Shirts">Shirts</option>
                        <option value="Jackets">Jackets</option>
                        <option value="Shoes">Shoes</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea class="w-full p-3 border rounded-lg" placeholder="Enter description" name="description"></textarea>
                </div>
                <button type="submit" class="w-full bg-black text-white p-3 rounded-lg  hover:bg-white hover:text-black">Add Product</button>
            </form>
        </div>
    </main>
    
    <!-- Add these before your closing </head> tag -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <!-- Replace the existing script section -->
    <script>
        $(document).ready(function() {
            $('#productName').on('input', function() {
                const productName = $(this).val();
               
                
                if (productName) {
                    // Using Axios for the AJAX request
                    axios.get('/admin/generate-slug', {
                        params: {
                            name: productName
                        }
                      
                    })
                    .then(function(response) {
                        console.log(response.data);
                        $('#slug').val(response.data.slug);
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
                } else {
                    $('#slug').val('');
                }
            });
    
                   
        });
    </script>
</x-adminlayout>
