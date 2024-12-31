@include('UsersPage.layouts.header')

<main>
    @yield('content')
    <!-- hero section start  -->
    <section id="hero" class=" position-relative overflow-hidden">
        <div class=" container text-center">

            <iframe autoplay loop muted playsinline class="hero-video" src="https://player.vimeo.com/video/1042477402?autoplay=1&loop=1&muted=1" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
            </iframe>

            <br>
            <br>

            <div class="row">
                <div class="detail mb-4">
                    <h1 class="hero-h1-text"> Select your car model and find<span class="text-primary"> the part you need </span> </h1>
                    <p class="hero-paragraph" id="hero-h1-text">We provide the best selection of car parts for your needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- search section start  -->
    <section id="search">
        <div class="container search-block p-5">
            <form class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <label for="category_id" class="label-style text-capitalize form-label">Category</label>
                    <div class="input-group date">
                        <select class="form-select form-control p-3" id="category_id" aria-label="Default select example" style="background-image: none;">
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <span class="search-icon-position position-absolute p-3">
                            <iconify-icon class="search-icons" icon="solar:bus-outline" style="color: #94CA21;"></iconify-icon>
                        </span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <label for="product_id" class="label-style text-capitalize form-label">Car</label>
                    <div class="input-group date">
                        <select class="form-select form-control p-3" id="product_id" aria-label="Default select example" style="background-image: none;">
                            <option value="" disabled selected>Select Car</option>
                        </select>
                        <span class="search-icon-position position-absolute p-3">
                            <iconify-icon class="search-icons" icon="solar:box-outline" style="color: #94CA21;"></iconify-icon>
                        </span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <label for="id" class="label-style text-capitalize form-label">Part</label>
                    <div class="input-group date">
                        <select class="form-select form-control p-3" id="id" aria-label="Default select example" style="background-image: none;">
                            <option value="" disabled selected>Select Part</option>
                        </select>
                        <span class="search-icon-position position-absolute p-3">
                            <iconify-icon class="search-icons" icon="solar:box-outline" style="color: #94CA21;"></iconify-icon>
                        </span>
                    </div>
                </div>

            </form>

            <div class="d-grid gap-2 mt-4">
                <button id="filter" class="btn btn-primary">Find your parts</button>
            </div>


        </div>
    </section>

    <!-- process section start  -->
    <section id="process">
        <div class=" process-content container" class="my-6">
            <br><br>
            <h2 class=" text-center my-5 pb-5">Our Car Parts <span class="text-primary"> Selection Process </span> </h2>
            <hr class="progress-line">
            <div class="row process-block">
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
                                    <div class="category-item" style="flex: 1 0 calc(33.333% - 1rem); max-width: calc(33.333% - 1rem); box-sizing: border-box; display: flex; justify-content: center; align-items: center;">
                                        <div class="card" style="width: 18rem; display: flex; flex-direction: column; align-items: center;">
                                            <img src="{{ asset('storage/' . $rs->category_image) }}" class="card-img-top"
                                                style="height: 230px; object-fit: contain;" alt="{{ $rs->category_name }}">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">{{ $rs->category_name }}</h5>
                                                <hr>
                                                <a href="{{ route('product', ['category_id' => $rs->category_id]) }}" class="btn btn-primary">View More</a>
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
                const itemSelect = document.getElementById('id');
                productSelect.innerHTML = '<option value="" disabled selected>Select Car</option>';
                itemSelect.innerHTML = '<option value="" disabled selected>Select Part</option>';

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
                const itemSelect = document.getElementById('id');
                itemSelect.innerHTML = '<option value="" disabled selected>Select Part</option>';

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.item_name;
                    itemSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching Part:', error));
    });
    document.getElementById('filter').addEventListener('click', function(e) {
        e.preventDefault();

        const categoryId = document.getElementById('category_id').value;
        const productId = document.getElementById('product_id').value;
        const id = document.getElementById('id').value;

        if (!categoryId || !productId || !id) {
            alert('Please select all options before proceeding.');
            return;
        }

        window.location.href = `/filter?category=${categoryId}&product=${productId}&id=${id}`;
    });
</script>


@include('UsersPage.layouts.footer')