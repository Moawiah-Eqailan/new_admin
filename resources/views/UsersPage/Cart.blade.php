@include('UsersPage.layouts.header')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .quantity-input {
            text-align: center;
            width: 60px;
        }
    </style>
</head>

<section class="position-relative">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    @if(empty($cartItems) || $cartItems->isEmpty())
                                    <div class="text-center">
                                        <h5>Your cart is empty</h5>
                                    </div>
                                    @else
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0">Shopping <span class="text-primary">Cart</span></h1>

                                    </div>
                                    <hr class="my-4">

                                    @foreach($cartItems as $cartItem)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ asset('storage/' . $cartItem->item->item_image) }}" class="img-fluid rounded-3" alt="{{ $cartItem->item->item_name }}">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="mb-0">{{ $cartItem->item->item_name }}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">

                                            <button class="btn btn-link px-2" type="button" onclick="this.nextElementSibling.stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input id="form1" min="1" name="quantity" value="{{ $cartItem->quantity }}" type="number" class="form-control form-control-sm quantity-input" style="width: 100px; text-align: center;" data-id="{{ $cartItem->id }}" readonly disabled /> <button class="btn btn-link px-2" type="button" onclick="this.previousElementSibling.stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0 item-total-price">{{$cartItem->item->item_price}}</h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 bg-body-tertiary">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">Items</h5>
                                        <h5>{{ $cartItems->count() }}</h5>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total</h5>
                                        <h5 id="total-price">{{ number_format($cartItems->sum(function ($item) { return $item->item->item_price * $item->quantity; }), 2) }} JOD</h5>
                                    </div>

                                    <!-- Payment Methods Section -->
                                    <h4 style="font-size: 17px;" class="fw-bold mb-5 mt-2 pt-1">Choose Payment Method</h4>
                                    <div class="form-check mb-3">
                                        <input class="text-uppercase" type="radio" name="paymentMethod" id="cash" value="cash" checked>
                                        <label class="form-check-label" for="cash">
                                            Pay with Cash
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="text-uppercase" type="radio" name="paymentMethod" id="visa" value="visa">
                                        <label class="form-check-label" for="visa">
                                            Pay with Visa
                                        </label>
                                    </div>

                                    <!-- استبدل الجزء الخاص بزر Checkout بهذا -->
                                    <button class="btn btn-primary btn-lg btn-block" style="font-size: 12px;">
                                        Proceed to Checkout
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>




@include('UsersPage.layouts.footer')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const quantityInputs = document.querySelectorAll(".quantity-input");
        const totalPrice = document.getElementById("total-price");

        quantityInputs.forEach(input => {
            input.previousElementSibling.addEventListener("click", function() {
                updateQuantity(input, -1);
            });

            input.nextElementSibling.addEventListener("click", function() {
                updateQuantity(input, 1);
            });
        });

        function updateQuantity(input, change) {
            let newQuantity = parseInt(input.value) + change;

            if (newQuantity < 1) newQuantity = 1;
            input.value = newQuantity;

            const cartItemId = input.dataset.id;

            fetch(`/cart/update/${cartItemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        totalPrice.textContent = data.total.toFixed(2);
                    } else {
                        alert("Failed to update quantity.");
                    }
                })
                .catch(error => {
                    console.error("Error updating quantity:", error);
                });
        }

        const checkoutButton = document.querySelector('button.btn.btn-primary.btn-lg.btn-block');

        checkoutButton.addEventListener("click", function(event) {
            event.preventDefault();

            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

            if (paymentMethod === "cash") {
                // إذا كان الدفع نقداً، نقوم أولاً بتفريغ السلة
                fetch('/cart/clear', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // بعد تفريغ السلة بنجاح، نعرض رسالة الشكر
                            Swal.fire({
                                title: 'شكراً لك!',
                                text: 'شكراً لشرائك من متجرنا طلبك قيد المعالجة',
                                icon: 'success',
                                confirmButtonText: 'حسناً'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('home') }}";
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error clearing cart:", error);
                    });
            } else if (paymentMethod === "visa") {
                window.location.href = "{{ route('CheckOut') }}";
            }
        });
    });
</script>