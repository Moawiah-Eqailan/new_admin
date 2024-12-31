@include('UsersPage.layouts.header')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<section id="item-detail" class="position-relative">
    <div class="container my-5 py-5">
        <h2 class="text-center my-5">Detail for <span class="text-primary">{{ $item->item_name }}</span></h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="item-detail-card d-flex align-items-center">
                                <div style="flex: 1; text-align: center;">
                                    <img src="{{ asset('storage/' . $item->item_image) }}"
                                        class="card-img-top"
                                        style="width: 100%; max-width: 300px; height: auto; object-fit: contain; border-radius: 8px;">
                                </div>
                                <div style="flex: 2; margin-left: 2rem;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">{{ $item->item_name }}
                                            <a href="javascript:void(0);" onclick="toggleHeart(this, '{{ $item->id }}')">
                                                <i class="{{ $isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color:red"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <hr>
                                    <p class="card-text">{{ $item->item_description }}</p>
                                    <div class="d-flex align-items-center">
                                        <label for="quantity" class="me-2">Quantity:</label>
                                        <input type="number" name="quantity" id="quantity" min="1" value="1" class="form-control" style="width: 80px;" readonly disabled />
                                    </div>
                                    <p class="card-text"><strong>Price:</strong> {{ $item->item_price }} JOD</p>
                                    <div class="d-flex mt-4">
                                        <button type="button" class="btn btn-primary danger me-2" onclick="addToCart('{{ $item->id }}', '{{ $item->item_name }}')">Add to Cart
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="items" class="position-relative">
    <div class="container my-5 py-5">
        <h2 class="text-center my-5">Related  <span class="text-primary">Products</span></h2>
        @if($relatedItems->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">No related items found for this product</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; justify-content: center; align-items: center;">
                                    @foreach($relatedItems as $item)
                                    <div class="item-card">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $item->item_image) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">
                                            <div class="card-body p-4" style="text-align: center;">
                                                <h4 style="font-size: 16px;" class="card-title">{{ $item->item_name }}</h4>
                                                <hr>
                                                <p class="card-text">{{ $item->item_price }} JOD</p>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('Detail', $item->id) }}" class="btn btn-primary" style="margin: 2px;"><i class="fa-solid fa-eye"></i></a>
                                                    <button style="margin: 2px;" type="button" class="btn btn-primary" onclick="addToCart('{{ $item->id }}', '{{ $item->item_name }}')">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>


<script>
    function toggleHeart(element, itemId) {
        const icon = element.querySelector('i');
        const isFavorite = icon.classList.contains('fa-solid');

        fetch(`/favorites/toggle/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    favorite: !isFavorite
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (isFavorite) {
                        icon.classList.remove('fa-solid', 'fa-heart');
                        icon.classList.add('fa-regular', 'fa-heart');
                    } else {
                        icon.classList.remove('fa-regular', 'fa-heart');
                        icon.classList.add('fa-solid', 'fa-heart');
                    }
                    location.reload();
                } else {
                    console.error('Failed to update the favorite status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }



    function addToCart(itemId, itemName) {
        let quantity = document.getElementById('quantity').value;
        console.log('Adding to cart:', itemId, 'Quantity:', quantity);

        fetch(`/check-auth`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.isAuthenticated) {
                    Swal.fire({
                        title: 'Login Required',
                        html: `Please log in to add <span style="color: #94CA21;">${itemName}</span> to your cart.`,
                        icon: 'warning',
                        confirmButtonText: 'Login',
                        cancelButtonText: 'Cancel',
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/login';
                        }
                    });
                } else {
                    fetch(`/cart/${itemId}/add`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                item_id: itemId,
                                quantity: quantity,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Item added to cart successfully');
                                location.reload();
                            } else {
                                console.log('Failed to add item to cart');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

@include('UsersPage.layouts.footer')