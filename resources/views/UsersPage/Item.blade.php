@include('UsersPage.layouts.header')

<section id="items" class="position-relative" style="margin-top:80px">
    <div class="container my-5 py-5">
        <h2 class="text-center my-5 text-3xl font-bold">
            <span class="text-blue-600 text-primary">{{ $items->first()->product->product_name ?? 'Coming Soon' }}</span>
        </h2>

        @if($items->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="text-lg text-gray-600">No items found for this Product</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                                    @foreach($items as $item)
                                    <div class="item-card transition-transform duration-300 hover:scale-105"
                                        style="flex: 0 1 calc(33.333% - 2rem); 
                                                max-width: calc(33.333% - 2rem); 
                                                min-width: 300px;
                                                margin-bottom: 2rem;">
                                        <!-- Heart Icon -->

                                        <a href="javascript:void(0);"
                                            onclick="toggleHeart(this, '{{ $item->id }}', '{{ $item->item_name }}')">
                                            <i class="{{ $item->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart"
                                                style="font-size: 1.5rem; color: red;">
                                            </i>
                                        </a>
                                        <div
                                            style="width: 100%; 
                                                    display: flex; 
                                                    flex-direction: column; 
                                                    align-items: center;
                                                    position: relative;">

                                            <!-- Image Container -->
                                            <div class="w-full overflow-hidden rounded-t-lg">
                                                <img src="{{ asset('storage/' . $item->item_image) }}"
                                                    class="transition-transform duration-300 hover:scale-105"
                                                    style="height: 230px; 
                                                            width: 100%;
                                                            object-fit: contain;"
                                                    alt="{{ $item->item_name }}">
                                            </div>

                                            <!-- Content -->
                                            <div class="card-body text-center p-6 w-full">
                                                <h4 class="text-xl font-semibold mb-4">{{ $item->item_name }}</h4>
                                                <hr class="my-4 border-gray-200">
                                                <p class="text-lg font-bold text-blue-600 mb-4">{{ $item->item_price }} JOD</p>

                                                <!-- Buttons -->
                                                <div class="flex justify-center gap-3">
                                                    <a href="{{ route('Detail', $item->id) }}"
                                                        class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg transition-colors duration-300 hover:bg-blue-700">
                                                        <i class="fa-solid fa-eye mr-2"></i>
                                                    </a>
                                                    <button type="button"
                                                        onclick="addToCart('{{ $item->id }}', '{{ $item->item_name }}')"
                                                        class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg transition-colors duration-300 hover:bg-blue-700">
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