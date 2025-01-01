@include('UsersPage.layouts.header')

<section id="products" class="position-relative"style="margin-top:80px">
    <div class="container my-5 py-5">

        <h2 class="text-center my-5">
            <span class="text-primary">{{ $product->first()->category->category_name ?? 'Coming Soon'}}</span>
        </h2>

        @if($product->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">No products found for this category</p>
        </div>
        @else
        <div class="swiper products-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">

                                    @foreach($product as $rs)
                                    <div class="product-item" style="flex: 1 0 calc(33.333% - 1rem); max-width: calc(33.333% - 1rem); box-sizing: border-box;">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $rs->product_image) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">
                                            <div class="card-body p-4 text-center">
                                                <h6 class="card-title">{{ $rs->product_name }}</h6>
                                                <hr>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('Item', $rs->product_id) }}" class="btn btn-primary">View More</a>
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



@include('UsersPage.layouts.footer')