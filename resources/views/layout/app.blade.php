@include('layout.header')

<main>
    @yield('content')
    <!-- hero section start  -->
    <section id="hero" class=" position-relative overflow-hidden">
        <div class=" container text-center">
            <div class="row">
                <div class="detail mb-4" style="padding:12px">
                    <h1> Select your car model and find<span class="text-primary"> the part you need </span> </h1>
                    <p class="hero-paragraph">We provide the best selection of car parts for your needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- search section start  -->
    <section id="search">
        <div class="container search-block p-5">
            <form class="row">
                <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                    <label for="category_id" class="label-style text-capitalize form-label">Category</label>
                    <div class="input-group date">
                        <select class="form-select form-control p-3" id="category_id" aria-label="Default select example" style="background-image: none;">
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <span class="search-icon-position position-absolute p-3">
                            <iconify-icon class="search-icons" icon="solar:bus-outline"></iconify-icon>
                        </span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                    <label for="product_id" class="label-style text-capitalize form-label">Product</label>
                    <div class="input-group date">
                        <select class="form-select form-control p-3" id="product_id" aria-label="Default select example" style="background-image: none;">
                            <option value="" disabled selected>Select Product</option>
                        </select>
                        <span class="search-icon-position position-absolute p-3">
                            <iconify-icon class="search-icons" icon="solar:box-outline"></iconify-icon>
                        </span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                    <label for="item_id" class="label-style text-capitalize form-label">Item</label>
                    <div class="input-group date">
                        <select class="form-select form-control p-3" id="item_id" aria-label="Default select example" style="background-image: none;">
                            <option value="" disabled selected>Select Item</option>
                        </select>
                        <span class="search-icon-position position-absolute p-3">
                            <iconify-icon class="search-icons" icon="solar:box-outline"></iconify-icon>
                        </span>
                    </div>
                </div>
                
            </form>
           
            <div class="d-grid gap-2 mt-4">
                <a href="{{route ('filter')}}" class="btn btn-primary">Find your parts</a>
            </div>

        </div>
    </section>

    <!-- process section start  -->
    <section id="process" >
        <div class=" process-content container" class="my-6">
            <br><br>
            <h2 class=" text-center my-5 pb-5">Our Car Parts <span class="text-primary"> Selection Process </span> </h2>
            <hr class="progress-line">
            <div id="row process-block">
                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> Choose the Parts You Need </h5>
                    <p>Select the car parts you need from our wide range of high-quality products.</p>
                </div>

                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> Payment Options </h5>
                    <p>You can pay using a credit card (Visa) or choose to pay cash on delivery. Choose the option that's most convenient for you.</p>
                </div>

                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> Delivery & Installation </h5>
                    <p>We offer reliable delivery service and installation by highly skilled professionals to ensure your car is in perfect condition.</p>
                </div>

                <div class="col-6 col-lg-3 text-start my-4">
                    <div class="bullet"></div>
                    <h5 class="text-uppercase mt-5"> Enjoy Your Car </h5>
                    <p>After installation, your car will be ready to drive with the best parts fitted perfectly, giving you peace of mind.</p>

                </div>

            </div>


        </div>
    </section>

    <!-- rental section start  -->
    <section id="rental" class="position-relative">
        <div class="container my-5 py-5">
            <h2 class="text-center my-5">Cars for <span class="text-primary">Category</span></h2>
            <div class="swiper rental-swiper mb-5">
                <div class="swiper-wrapper">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
                                        @foreach($categories as $rs)
                                        <!-- Swiper Slide -->
                                        <div class="category-item" style="flex: 1 0 21%; max-width: 18rem;">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $rs->category_image) }}" class="card-img-top"
                                                    style="width: 100%; height: 230px; object-fit: cover;" alt="{{ $rs->category_name }}">
                                                <div class="card-body p-4" style="text-align: center;">
                                                    <h4 class="card-title">{{ $rs->category_name }}</h4>
                                                    <hr>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('product', ['category_id' => $rs->category_id]) }}" class="btn btn-primary">View More</a>
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
        </div>
    </section>
</main>



<script>
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;

        fetch(`/get-products/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const productSelect = document.getElementById('product_id');
                const itemSelect = document.getElementById('item_id');
                productSelect.innerHTML = '<option value="" disabled selected>Select Product</option>';
                itemSelect.innerHTML = '<option value="" disabled selected>Select Item</option>';

                data.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.product_id;
                    option.textContent = product.product_name;
                    productSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    });

    document.getElementById('product_id').addEventListener('change', function() {
        const productId = this.value;

        fetch(`/get-items/${productId}`)
            .then(response => response.json())
            .then(data => {
                const itemSelect = document.getElementById('item_id');
                itemSelect.innerHTML = '<option value="" disabled selected>Select Item</option>';

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.item_id;
                    option.textContent = item.item_name;
                    itemSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching items:', error));
    });
</script>


@include('layout.footer')