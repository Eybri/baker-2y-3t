$(document).ready(function () {
    function loadProducts(page = 1) {
        $.ajax({
            url: `/api/userproducts?page=${page}`,
            method: 'GET',
            success: function(response) {
                renderProducts(response.products);
                generatePagination(response.total, page, response.perPage);
            },
            error: function(xhr, status, error) {
                console.error('Pagination Error:', status, error);
            }
        });
    }

    function renderProducts(products) {
        let productsHtml = '';
        products.forEach(product => {
            productsHtml += `
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="${product.image}" class="card-img-top" alt="${product.name}">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <p class="card-text">$${product.price}</p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>`;
        });
        $('#productContainer').html(productsHtml);
    }

    function generatePagination(total, currentPage, perPage) {
        let totalPages = Math.ceil(total / perPage);
        let paginationHtml = '';

        if (totalPages > 1) {
            for (let i = 1; i <= totalPages; i++) {
                paginationHtml += `<button class="btn btn-outline-primary page-button ${i === parseInt(currentPage) ? 'active' : ''}" data-page="${i}">${i}</button> `;
            }
        }

        $('#pagination-container').html(paginationHtml);
    }

    $(document).on('click', '.page-button', function() {
        let page = $(this).data('page');
        loadProducts(page);
    });

    $(document).ready(function() {
        loadProducts(); // Load the initial products
    });
    // Fetch products on page load
    fetchProducts();

    // Function to fetch products from API
    function fetchProducts() {
        $.ajax({
            url: '/api/userproducts',
            method: 'GET',
            success: function (data) {
                console.log('Products fetched:', data); // Debug: Log fetched data
                if (data && Array.isArray(data.products)) {
                    renderProducts(data.products);
                } else {
                    console.error('Products data is not an array:', data.products);
                    $('#productContainer').html('<p class="col-12">No products found.</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to fetch products:', error);
                $('#productContainer').html('<p class="col-12">No products found.</p>');
            }
        });
    }

    // Function to render products
    function renderProducts(products) {
        let productContainer = $('#productContainer');
        productContainer.empty();

        if (products.length === 0) {
            productContainer.html('<p class="col-12">No products found.</p>');
        } else {
            products.forEach(product => {
                let imagePaths = product.image.split(',');
                let carouselItems = imagePaths.map((imagePath, index) => `
                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img class="d-block w-100" src="${imagePath}" alt="${product.name}" style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                `).join('');

                let productCard = `
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div id="productCarousel${product.id}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    ${carouselItems}
                                </div>
                                <a class="carousel-control-prev" href="#productCarousel${product.id}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#productCarousel${product.id}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">${product.name}</h4>
                                <p class="card-text">${product.description}</p>
                                <h5>$${product.price}</h5>
                            </div>
                            <div class="card-footer">
                                <button class="add-to-cart-btn btn btn-primary" data-id="${product.id}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                `;

                productContainer.append(productCard);
            });
        }
    }

    // Handle Add to Cart button click for dynamically loaded content
    $(document).on('click', '.add-to-cart-btn', function () {
        let productId = $(this).data('id');
        
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert('Product added to cart successfully!');
                updateCartCount(); // Update cart count after adding item
            },
            error: function (xhr, status, error) {
                console.error('Failed to add product to cart:', xhr.responseText);
                alert('Failed to add product to cart. Please try again.');
            }
        });
    });

    // Function to update cart count
    function updateCartCount() {
        $.ajax({
            url: '/cart/count',
            method: 'GET',
            success: function (response) {
                $('#cart-count').text(response.count);
            },
            error: function (xhr, status, error) {
                console.error('Failed to update cart count:', error);
            }
        });
    }
});
