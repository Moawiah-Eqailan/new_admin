@include('UsersPage.layouts.header')

<main>
    @yield('content')
    <!-- hero section start  -->
    <section id="hero" class=" position-relative overflow-hidden" style="margin-top:50px">
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
                <!-- Category Dropdown -->
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <label for="category_id" class="label-style text-capitalize form-label">Category</label>
                    <select class="form-select form-control p-3" id="category_id" style="background-image: none;">
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Dropdown -->
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <label for="product_id" class="label-style text-capitalize form-label">Product</label>
                    <select class="form-select form-control p-3" id="product_id" style="background-image: none;">
                        <option value="" disabled selected>Select Product</option>
                    </select>
                </div>

                <!-- Item Dropdown -->
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <label for="item_id" class="label-style text-capitalize form-label">Item</label>
                    <select class="form-select form-control p-3" id="item_id" style="background-image: none;">
                        <option value="" disabled selected>Select Item</option>
                    </select>
                </div>

            </form>

            <div class="d-grid gap-2 mt-4">
                <button id="filter" class="btn btn-primary">Find your parts</button>
            </div>

            <div id="error-message" class="text-danger mt-3" style="display: none;"></div>
        </div>
    </section>

    <br><br>
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
                    <p>You can pay using choose to pay cash on delivery..</p>
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
            <h2 class="text-center my-5 text-3xl font-bold">Cars for <span class="text-blue-600">Category</span></h2>

            <div class="swiper rental-swiper mb-5">
                <div class="swiper-wrapper">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
                                        @foreach($categories as $rs)
                                        <div class="category-item transition-transform duration-300 hover:scale-105"
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
                                                    <img src="{{ asset('storage/' . $rs->category_image) }}"
                                                        class="card-img-top transition-transform duration-300 hover:scale-105"
                                                        style="height: 230px; 
                                                                width: 100%;
                                                                object-fit: contain;"
                                                        alt="{{ $rs->category_name }}">
                                                </div>
                                                <div class="card-body text-center p-6 w-full">
                                                    <h5 class="card-title text-xl font-semibold mb-4">{{ $rs->category_name }}</h5>
                                                    <hr class="my-4 border-gray-200">
                                                    <a href="{{ route('product', ['category_id' => $rs->category_id]) }}" 
                                                        class="btn btn-primary inline-block px-6 py-3 bg-blue-600 text-white rounded-lg transition-colors duration-300 hover:bg-blue-700 view-more">
                                                        View More
                                                    </a>
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
    const productsByCategory = @json($productsByCategory);
    const itemsByProduct = @json($itemsByProduct);

    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const productSelect = document.getElementById('product_id');
        const id = document.getElementById('item_id');

        productSelect.innerHTML = '<option value="" disabled selected>Select Product</option>';
        id.innerHTML = '<option value="" disabled selected>Select Item</option>';

        if (productsByCategory[categoryId]) {
            productsByCategory[categoryId].forEach(product => {
                const option = document.createElement('option');
                option.value = product.product_id;
                option.textContent = product.product_name;
                productSelect.appendChild(option);
            });
        }
    });

    document.getElementById('product_id').addEventListener('change', function() {
        const productId = this.value;
        const id = document.getElementById('item_id');

        id.innerHTML = '<option value="" disabled selected>Select Item</option>';

        if (itemsByProduct[productId]) {
            itemsByProduct[productId].forEach(item => {
                const option = document.createElement('option');
                option.value = item.item_id;
                option.textContent = item.item_name;
                id.appendChild(option);
            });
        }
    });

    document.getElementById('filter').addEventListener('click', function(e) {
        e.preventDefault();

        const categoryId = document.getElementById('category_id').value;
        const productId = document.getElementById('product_id').value;
        const id = document.getElementById('item_id').value;
        const errorMessage = document.getElementById('error-message');

        errorMessage.style.display = 'none';
        errorMessage.textContent = '';

        if (!categoryId || !productId || !id) {
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Please select all options before proceeding.';
            return;
        }

        window.location.href = `/filter?category=${categoryId}&product=${productId}&id=${id}`;
    });



    document.querySelectorAll('.view-more').forEach(button => {
    button.addEventListener('click', function(event) {
        @auth
        return;
        @else
        event.preventDefault();
        Swal.fire({
            title: 'Please log in first',
            text: 'You must log in to access your Product.',
            icon: 'warning',
            confirmButtonText: 'Log In',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route("login") }}';
            }
        });
        @endauth
    });
});

</script>


<footer id="footer" class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2025 BAT<span class="text-primary">PARTS</span> </p>
        <div class="d-flex justify-content-center">
            <a href="https://www.facebook.com" class="text-white mx-2">Facebook</a>
            <a href="https://www.x.com" class="text-white mx-2">𝕏</a>
            <a href="https://www.instagram.com" class="text-white mx-2">Instagram</a>

        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>



</body>

</html>