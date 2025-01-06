@include('UsersPage.layouts.header')

<section id="products" class="position-relative" style="margin-top:80px">
    <div class="container my-5 py-5">
        <h2 class="text-center my-5 text-3xl font-bold">
            <span class="text-blue-600 text-primary">{{ $product->first()->category->category_name ?? 'Coming Soon'}}</span>
        </h2>

        @if($product->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="text-lg text-gray-600">No products found for this category</p>
        </div>
        @else
        <div class="swiper products-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                                    @foreach($product as $rs)
                                    <div class="product-item transition-transform duration-300 hover:scale-105" 
                                         style="flex: 0 1 calc(33.333% - 2rem); 
                                                max-width: calc(33.333% - 2rem); 
                                                min-width: 300px;
                                                margin-bottom: 2rem;">
                                        <div 
                                             style="width: 100%; 
                                                    display: flex; 
                                                    flex-direction: column; 
                                                    align-items: center;">
                                            <div class="w-full overflow-hidden rounded-t-lg">
                                                <img src="{{ asset('storage/' . $rs->product_image) }}" 
                                                     class="card-img-top transition-transform duration-300 hover:scale-105"
                                                     style="height: 230px; 
                                                            width: 100%;
                                                            object-fit: contain;" 
                                                     alt="{{ $rs->product_name }}">
                                            </div>
                                            <div class="card-body text-center p-6 w-full">
                                                <h5 class="card-title text-xl font-semibold mb-4">{{ $rs->product_name }}</h5>
                                                <hr class="my-4 border-gray-200">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('Item', $rs->product_id) }}" 
                                                       class="btn btn-primary inline-block px-6 py-3 bg-blue-600 text-white rounded-lg transition-colors duration-300 hover:bg-blue-700">
                                                        View More
                                                    </a>
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