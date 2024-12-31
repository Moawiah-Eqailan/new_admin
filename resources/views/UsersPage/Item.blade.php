@include('UsersPage.layouts.header')

<section id="items" class="position-relative">
    <div class="container my-5 py-5">

        <h2 class="text-center my-5">
            <span class="text-primary">{{ $items->first()->product->product_name ?? 'Coming Soon' }}</span>
        </h2>

        @if($items->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">No items found for this Product</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">

                                    @foreach($items as $item)
                                    <div class="item-card" style="flex: 1 0 calc(33.333% - 1rem); max-width: calc(33.333% - 1rem); box-sizing: border-box;">
                                        <div class="card">
                                            <a href="javascript:void(0);" onclick="toggleHeart(this, '{{ $item->id }}', '{{ $item->item_name }}')">
                                                <i class="{{ $item->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color: red;"></i>
                                            </a>
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
    function toggleHeart(element, itemId, itemName) {
        const icon = element.querySelector('i');
        const isFavorite = icon.classList.contains('fa-solid');

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
                        html: `Please log in to add <span style="color: #94CA21;">${itemName}</span> to your favorites.`,
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
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }




    function addToCart(itemId, itemName) {
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
                    fetch(`/item/${itemId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                item_id: itemId,
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