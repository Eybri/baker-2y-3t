$(document).ready(function() {
    function updateCartCount() {
        $.ajax({
            url: '/cart/count',
            method: 'GET',
            success: function(response) {
                $('#cart-count').text(response.count);
            },
            error: function(response) {
                console.error('Failed to fetch cart count.');
            }
        });
    }

    // Initial cart count update
    updateCartCount();

    // Handle Add to Cart button click
    $('.add-to-cart-btn').on('click', function() {
        let productId = $(this).data('id');
        
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Product added to cart successfully!');
                updateCartCount(); // Update cart count after adding item
            },
            error: function(response) {
                console.error('Failed to add product to cart.');
                alert('Failed to add product to cart. Please try again.');
            }
        });
    });

    // Polling to update cart count every 5 seconds
    setInterval(updateCartCount, 5000);


    function selectItems(productIds) {
        $.ajax({
            url: '/cart/select',
            method: 'POST',
            data: {
                product_ids: productIds,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    }

    function deselectItems(productIds) {
        $.ajax({
            url: '/cart/deselect',
            method: 'POST',
            data: {
                product_ids: productIds,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    }

    function updateTotalAmount() {
        let totalAmount = 0;
        $('.item-checkbox:checked').each(function() {
            const quantity = $(this).data('quantity');
            const price = $(this).data('price');
            totalAmount += quantity * price;
        });
        $('#total-amount').text(totalAmount.toFixed(2));
    }

    function isTotalAmountValid() {
        return parseFloat($('#total-amount').text()) > 0;
    }

    // Handle Remove from Cart button click
    $('.remove-from-cart-btn').on('click', function() {
        const productId = $(this).data('id');

        $.ajax({
            url: '/cart/remove',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload(); // Reload the page to update the cart view
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    });

    // Handle Select All checkbox
    $('#select-all').on('click', function() {
        const isChecked = this.checked;
        $('.item-checkbox').prop('checked', isChecked);
        updateTotalAmount();

        const productIds = [];
        $('.item-checkbox').each(function() {
            if (isChecked && !$(this).is(':checked')) {
                productIds.push($(this).data('id'));
            }
        });

        $.ajax({
            url: '/cart/select',
            method: 'POST',
            data: {
                product_ids: productIds,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    });

    // Handle individual item checkbox change
    $('.item-checkbox').on('change', function() {
        updateTotalAmount();

        const productId = $(this).data('id');
        const isSelected = $(this).is(':checked');
        const url = isSelected ? '/cart/select' : '/cart/deselect';

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                product_ids: [productId],
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    });

    // Handle Increase Quantity button click
    $('.increase-quantity-btn').on('click', function() {
        const productId = $(this).data('id');

        $.ajax({
            url: '/cart/increase',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload(); // Reload the page to update the cart view
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    });

    // Handle Decrease Quantity button click
    $('.decrease-quantity-btn').on('click', function() {
        const productId = $(this).data('id');

        $.ajax({
            url: '/cart/decrease',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload(); // Reload the page to update the cart view
            },
            error: function(response) {
                console.error(response.responseText);
            }
        });
    });

    // Handle Checkout button click
    $('#checkout-btn').on('click', function(event) {
        if (!isTotalAmountValid()) {
            event.preventDefault();
            
            // Set the message for the custom alert
            $('#custom-alert-message').text('Please select at least one item to continue.');
            
            // Display the custom alert
            $('#custom-alert').show();
        } else {
            // Proceed with the checkout process
            window.location.href = $(this).attr('href');
        }
    });

    // Close the custom alert when the close button is clicked
    $('#custom-alert-close').on('click', function() {
        $('#custom-alert').hide();
    });
      // Handle Select All checkbox
      $('#select-all').on('click', function() {
        const isChecked = this.checked;
        $('.item-checkbox').prop('checked', isChecked);
        updateTotalAmount();

        const productIds = [];
        $('.item-checkbox').each(function() {
            if (isChecked && !$(this).is(':checked')) {
                productIds.push($(this).data('id'));
            }
        });

        console.log('Sending product IDs:', productIds); // Debugging
        $.ajax({
            url: isChecked ? '/cart/select' : '/cart/deselect',
            method: 'POST',
            data: {
                product_ids: productIds,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Response:', response.message); // Debugging
            },
            error: function(response) {
                console.error('Error:', response.responseText); // Debugging
            }
        });
        
        $('#select-all').on('change', function() {
            const isChecked = this.checked;
            const productIds = [];
    
            $('.item-checkbox').each(function() {
                $(this).prop('checked', isChecked);
                productIds.push($(this).data('id'));
            });
    
            const url = isChecked ? '/cart/select' : '/cart/deselect';
            
            if (productIds.length > 0) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        product_ids: productIds,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.message);
                        updateTotalAmount(); // Update total amount after success
                    },
                    error: function(response) {
                        console.error(response.responseText);
                    }
                });
            }
        });
    
        function updateTotalAmount() {
            let total = 0;
            $('.item-checkbox:checked').each(function() {
                const quantity = $(this).data('quantity');
                const price = $(this).data('price');
                total += quantity * price;
            });
            $('#total-amount').text(total.toFixed(2));
        }
      
    });
    
    
});
