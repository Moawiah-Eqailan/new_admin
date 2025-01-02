@include('UsersPage.layouts.header')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .quantity-input {
            text-align: center;
            width: 60px;
        }

        .btn-danger {
            border-radius: 50%;
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: rotate(90deg);
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
                                            <input id="form1" min="1" name="quantity" value="{{ $cartItem->quantity }}" type="number" class="form-control form-control-sm quantity-input" style="width: 100px; text-align: center;" data-id="{{ $cartItem->id }}" readonly disabled />
                                            <button class="btn btn-link px-2" type="button" onclick="this.previousElementSibling.stepUp()">
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
                                        <h5 id="total-items">{{ $cartItems->count() }}</h5>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total</h5>
                                        <h5 id="total-price">{{ number_format($cartItems->sum(function ($item) { return $item->item->item_price * $item->quantity; }), 2) }} </h5>
                                        <h5 id="total-price"> JOD</h5>
                                    </div>

                                    @if(!empty($cartItems) && !$cartItems->isEmpty())
                                    <h4 style="font-size: 17px;" class="fw-bold mb-5 mt-2 pt-1">Choose Payment Method</h4>
                                    <div class="form-check mb-3">
                                        <input class="text-uppercase" type="radio" name="paymentMethod" id="cash" value="cash" checked>
                                        <label class="form-check-label" for="cash">
                                            Pay with Cash
                                        </label>
                                    </div>
                                    <button class="btn btn-primary btn-lg btn-block" style="font-size: 12px;" id="checkout-button">
                                        Proceed to Checkout
                                    </button>
                                    @endif

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

const style = document.createElement('style');
    style.textContent = `
        .text-left {
            text-align: left !important;
            display: block;
            width: 100%;
        }
        .form-group i {
            position: absolute;
            right: 3rem;
            margin-top: 2.4rem;
            color: #94CA21;
        }
    `;
    document.head.appendChild(style);
    document.addEventListener("DOMContentLoaded", function() {
        const quantityInputs = document.querySelectorAll(".quantity-input");
        const totalPrice = document.getElementById("total-price");

        quantityInputs.forEach(input => {
            input.previousElementSibling.addEventListener("click", function() {
                updateQuantity(input, -0);
            });

            input.nextElementSibling.addEventListener("click", function() {
                updateQuantity(input, 0);
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

        const checkoutButton = document.querySelector('#checkout-button');
checkoutButton.addEventListener("click", function(event) {
    event.preventDefault();

    Swal.fire({
        title: '<strong>This is the information that will be used to contact you</strong>',
        html: `
        <form class="edit-form">
            @csrf
            <div class="form-group">
                <label class="form-label text-left"><i class="fas fa-user"></i>Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly disabled>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-label text-left"><i class="fas fa-envelope"></i>Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly disabled>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-label text-left"><i class="fas fa-phone"></i>Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}" readonly disabled>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-label text-left"><i class="fas fa-home"></i>Address</label>
                <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}" readonly disabled>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-label text-left"> <i class="fas fa-flag"></i>Province</label>
                <input type="text" name="state" class="form-control" value="{{ Auth::user()->state }}" readonly disabled>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-label text-left"><i class="fas fa-globe"></i>Country</label>
                <input type="text" class="form-control" value="Jordan" readonly disabled>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-label text-left"><i class="fas fa-city"></i>City</label>
                <input type="text" class="form-control" value="{{ Auth::user()->city }}" readonly disabled>
            </div>
        </form>
    `,
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonText: 'DONE',
        preConfirm: () => {
            const cartItems = @json($cartItems); // تم تحويل cartItems إلى JSON
            const total = @php echo $cartItems->sum(function($item) { return $item->item->item_price * $item->quantity; }); @endphp;
            const userId = @php echo Auth::id(); @endphp;

            // التأكد من أن الـ CSRF token مضاف بشكل صحيح
            fetch('/orders/create', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        cartItems: cartItems,
        total: total,
        userId: userId
    })
})
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                return Promise.reject('Failed to create order');
            })
            .then(data => {
                if (data.success) {
                    Swal.fire('Order placed successfully', '', 'success');
                } else {
                    Swal.fire('Error placing order', data.error || 'Unknown error', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred while placing the order.', 'error');
            });
        }
    });
});
    });
</script>