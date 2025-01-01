@include('UsersPage.layouts.header')

<section id="items" class="position-relative"style="margin-top:80px">
    <div class="container my-5 py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        @if($favoriteItems->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">You have no favorite products.</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; justify-content: center; align-items: center;">
                                    @foreach($favoriteItems as $favorite)
                                    <div class="item-card">
                                        <a href="javascript:void(0);" onclick="toggleHeart(this, `{{ $favorite->id }}`)">
                                            <i class="{{ $favorite->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color:red"></i>
                                        </a>
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $favorite->item_image) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">
                                            <div class="card-body p-4" style="text-align: center;">
                                                <h4 class="card-title">{{ $favorite->item_name }}</h4>
                                                <hr>
                                                <p class="card-text">{{ $favorite->item_price }} JOD</p>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('Detail', $favorite->id) }}" class="btn btn-primary" style="margin: 2px;"><i class="fa-solid fa-eye"></i></a>
                                                    <button style="margin: 2px;" type="button" class="btn btn-primary" onclick="addToCart('{{ $favorite->id }}')">
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

    function addToCart(itemId) {


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
                    Swal.fire({
                        icon: 'success',
                        title: 'Item Added to Item!',
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Failed to add this product to your Item. Please try again.',
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
    };
</script>


@include('UsersPage.layouts.footer')