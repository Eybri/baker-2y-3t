@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>
    <form id="checkout-form" action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="recipient_name">Recipient Name</label>
            <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Shipping Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <button id="placeOrderBtn" type="button" class="btn btn-primary">Place Order</button>
    </form>

    <script>
      $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#placeOrderBtn').click(function() {
            let recipient_name = $('#recipient_name').val();
            let phone = $('#phone').val();
            let address = $('#address').val();
            let city = $('#city').val();
            let postal_code = $('#postal_code').val();
            let country = $('#country').val();

            if (!recipient_name || !phone || !address || !city || !postal_code || !country) {
                alert('Please fill all the fields.');
                return;
            }

            let formData = $('#checkout-form').serialize();
            $.ajax({
            url: "{{ route('checkout.place') }}", // Updated route for form submission
            method: 'POST',
            data: {
                recipient_name: recipient_name,
                phone: phone,
                address: address,
                city: city,
                postal_code: postal_code,
                country: country
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.redirect_url) {
                    window.location.href = response.redirect_url; // Redirect to the order confirmation page
                } else {
                    alert('Order placed successfully!');
                }
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
                alert('Failed to place order. Please try again.');
            }
        });
    });
    });
    </script>
@endsection
