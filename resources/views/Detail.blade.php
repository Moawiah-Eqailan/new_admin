@include('layout.header')

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
                                        style="width: 100%; max-width: 300px; height: auto; object-fit: cover; border-radius: 8px;">
                                </div>
                                <div style="flex: 2; margin-left: 2rem;">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">{{ $item->item_name }}
                                            <a href="javascript:void(0);" onclick="toggleHeart(this)">
                                                <i class="{{ $isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color:red" onclick="toggleHeart(this)"></i>
                                            </a>

                                        </h4>
                                    </div>
                                    <hr>
                                    <p class="card-text">{{ $item->item_description }}</p>
                                    <p class="card-text"><strong>Price:</strong> {{ $item->item_price }} Jd</p>
                                    <div class="d-flex mt-4">
                                        <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
                                        <button type="button" class="btn btn-primary me-2" onclick="addToCart('{{ $item->id }}')">Add to Cart</button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function toggleHeart(element) {
        const icon = element.querySelector('i');
        const isFavorite = icon.classList.contains('fa-solid');
        const itemId = "{{ $item->id }}";

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
    };



    function addToCart(itemId) {
    console.log('Adding to cart:', itemId); // Check if the itemId is correct
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you really want to add this product to your cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, add it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/cart/${itemId}/add`, {
                
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    item_id: itemId,
                }),
            })
            .then(response => {
                console.log(response); // Check if response is correct
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Item Added to Cart!',
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Failed to add this product to your cart. Please try again.',
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
}

</script>





@include('layout.footer')