@include('UsersPage.layouts.header')

<section id="items" class="position-relative" style="margin-top:80px">
    <div class="container my-5 py-5">
        <h2 class="text-center my-5 text-3xl font-bold">
            <span class="text-blue-600 text-primary">Favorite</span>
        </h2>
        @if($favoriteItems->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="text-lg text-gray-600">You have no favorite products.</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                                    @foreach($favoriteItems as $favorite)
                                    <div class="item-card transition-transform duration-300 hover:scale-105"
                                        style="flex: 0 1 calc(33.333% - 2rem); 
                                                max-width: calc(33.333% - 2rem); 
                                                min-width: 300px;
                                                margin-bottom: 2rem;">
                                        <!-- Heart Icon -->
                                        <a href="javascript:void(0);"
                                            onclick="toggleHeart(this, '{{ $favorite->id }}')">
                                            <i class="{{ $favorite->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart"
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
                                                <img src="{{ asset('storage/' . $favorite->item_image) }}"
                                                    class="transition-transform duration-300 hover:scale-105"
                                                    style="height: 230px; 
                                                            width: 100%;
                                                            object-fit: contain;"
                                                    alt="{{ $favorite->item_name }}">
                                            </div>

                                            <!-- Content -->
                                            <div class="card-body text-center p-6 w-full">
                                                <h4 class="text-xl font-semibold mb-4">{{ $favorite->item_name }}</h4>
                                                <hr class="my-4 border-gray-200">
                                                <p class="text-lg font-bold text-blue-600 mb-4">{{ $favorite->item_price }} JOD</p>

                                                <!-- Buttons -->
                                                <div class="flex justify-center gap-3">
                                                    <a href="{{ route('Detail', $favorite->id) }}"
                                                        class="btn btn-primary inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg transition-colors duration-300 hover:bg-blue-700">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <button type="button"
                                                        onclick="addToCart('{{ $favorite->id }}', '{{ $favorite->item_name }}')"
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
    function toggleHeart(element, itemId) {
        const icon = element.querySelector('i');
        const isFavorite = icon.classList.contains('fa-solid');

        if (isFavorite) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to remove this product from your favorites?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
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
                                icon.classList.remove('fa-solid', 'fa-heart');
                                icon.classList.add('fa-regular', 'fa-heart');

                                {
                                    window.location.href = "/favorites";
                                };
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed!',
                                    text: 'Failed to update the favorite status. Please try again.',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'An error occurred!',
                                text: 'An error occurred. Please try again.',
                            });
                        });
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
                        icon.classList.remove('fa-regular', 'fa-heart');
                        icon.classList.add('fa-solid', 'fa-heart');

                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Favorites!',
                            text: 'This product has been successfully added to your favorites.',
                        }).then(() => {
                            window.location.href = "/favorites";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: 'Failed to update the favorite status. Please try again.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred!',
                        text: 'An error occurred. Please try again.',
                    });
                });
        }
    };

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
                if (data.isAuthenticated) {
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
                                console.log(`${itemName} تمت إضافته إلى السلة.`);
                                location.reload();
                            } else {
                                console.error('فشل في إضافة المنتج إلى السلة.');
                            }
                        })
                        .catch(error => {
                            console.error('حدث خطأ أثناء إضافة العنصر:', error);
                        });
                } else {
                    console.error('يرجى تسجيل الدخول لإضافة العنصر.');
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء التحقق من تسجيل الدخول:', error);
            });
    }
</script>


@include('UsersPage.layouts.footer')