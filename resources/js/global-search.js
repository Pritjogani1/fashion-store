$(document).ready(function() {
    $('#global-search-input').on('keyup', function() {
        let query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#global-search-results').empty().removeClass('hidden');
                    if (data.length > 0) {
                        $.each(data, function(index, product) {
                            $('#global-search-results').append(`
                                <a href="/product-preview/${product.slug}" 
                                   class="block px-4 py-2 hover:bg-gray-100">
                                    <div class="flex items-center">
                                        <img src="/storage/${product.image}" alt="${product.name}" class="w-10 h-10 object-cover rounded">
                                        <div class="ml-3">
                                            <h3 class="font-medium">${product.name}</h3>
                                            <p class="text-sm text-gray-600">₹${product.price}</p>
                                        </div>
                                    </div>
                                </a>
                            `);
                        });
                    } else {
                        $('#global-search-results').append('<p class="px-4 py-2 text-gray-600">No products found</p>');
                    }
                }
            });
        } else {
            $('#global-search-results').empty().addClass('hidden');
        }
    });
});