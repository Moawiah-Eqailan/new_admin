@include('layout.header')

<section id="cart" class="position-relative">
    <div class="container my-5 py-5">
        <h2 class="text-center my-5">Shopping <span class="text-primary">Cart</span></h2>

        @if(empty($cartItems) || $cartItems->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">Your cart is empty.</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
                                    @foreach($cartItems as $cartItem)
                                    <div class="item-card" style="flex: 1 0 21%; max-width: 18rem;">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $cartItem->item->item_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
                                            <div class="card-body p-4" style="text-align: center;">
                                                <h4 class="card-title">{{ $cartItem->item->item_name }}</h4>
                                                <hr>
                                                <p class="card-text">{{ number_format($cartItem->item->item_price, 2) }} JOD</p>
                                                
                                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" required>
                                                    <button type="submit" class="btn btn-primary my-2">Update Quantity</button>
                                                </form>

                                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
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

        <!-- Total Price -->
        <div class="total text-center my-5">
            <h3>Total: {{ number_format($cartItems->sum(function ($item) { return $item->item->item_price * $item->quantity; }), 2) }} JOD</h3>
        </div>

        @endif
    </div>
</section>

@include('layout.footer')
