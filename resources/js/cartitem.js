
$(document).ready(function() {
    console.log("hello");
    $('head').append('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">');


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('.add-to-cart').click(function(e) {
    e.preventDefault();
    const productId = $(this).data('id');
    console.log(productId);
    $.ajax({
        url: `/add-to-cart/${productId}`,
        method: 'POST',
        success: function(response) {
            updateCartCount(response.cart);
            Toastify({
                text: "Product added to cart",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#4CAF50"
            }).showToast();
        },
        error: function(xhr) {
            Toastify({
                text: "Failed to add product to cart at first you login in website",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#F44336"
            }).showToast();
            console.error(xhr.responseText);
        }
    });
});

function updateCartCount(cart) {
    const itemCount = Object.values(cart).reduce((total, item) => total + item.quantity, 0);
    $('#cart-count').text(itemCount);
}

});