@include('UsersPage.layouts.header')

<section id="items" class="position-relative">
    <div class="container my-5 py-5">

        @if($filteredParts->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">No parts found for the selected criteria.</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="d-flex flex-wrap justify-content-between gap-4">
                                    @foreach($filteredParts as $item)
                                    <div class="card mb-3" style="max-width: 540px; flex: 1 0 {{ $filteredParts->count() == 1 ? '100%' : '30%' }}; max-width: {{ $filteredParts->count() == 1 ? '100%' : '30%' }}">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                @if($item->item_image)
                                                <img src="{{ asset('storage/' . $item->item_image) }}" class="img-fluid rounded-start" alt="item-image" style="height: 200px; object-fit: contain;">
                                                @else
                                                <p class="text-center">No image available</p>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="card-title">{{ $item->item_name }}
                                                            <a href="javascript:void(0);" onclick="toggleHeart(this)">
                                                                <i class="{{ $item->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color:red" onclick="toggleHeart(this)"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <hr>
                                                    <h5 class="card-title">{{ $item->item_name }}</h5>
                                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                    <p class="card-text">{{ $item->item_description }}</p>

                                                    <button type="button" class="btn btn-primary me-2" onclick="addToCart('{{ $item->id }}')">
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

        <div class="d-flex mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
        </div>
    </div>
</section>

@include('UsersPage.layouts.footer')


<script>
  function toggleHeart(element) {
        const icon = element.querySelector('i');
        const isFavorite = icon.classList.contains('fa-solid');
        const itemId = "{{ $item->id }}";

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
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

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
</script>