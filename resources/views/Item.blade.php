@include('layout.header')

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

                                    <div class="item-card" style="flex: 1 0 21%; max-width: 18rem;">
                                        <a href="javascript:void(0);" onclick="toggleHeart(this, '{{ $item->id }}')">
                                            <i class="{{ $item->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color: red;"></i>
                                        </a>
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $item->item_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
                                            <div class="card-body p-4" style="text-align: center;">
                                                <h4 style="font-size: 16px;" class="card-title">{{ $item->item_name }}</h4>
                                                <a href="javascript:void(0);" onclick="toggleHeart(this)">
                                                </a>
                                                <hr>
                                                <p class="card-text">{{ $item->item_price }} JOD</p>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('Detail', $item->id) }}" class="btn btn-primary">View More</a>
                                                </div>
                                                <br>
                                                <!-- <div class="d-flex justify-content-center">
                                                    <a href="cart" class="btn btn-primary">Add To Cart</a>
                                                </div> -->
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

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Removed from Favorites!',
                                    text: 'This product has been successfully removed from your favorites.',
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
    }
</script>

@include('layout.footer')