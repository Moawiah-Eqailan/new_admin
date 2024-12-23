@include('layout.header')







<div class="container mt-5">
    <h1>Available Parts</h1>

    <h2>Categories</h2>
    <ul>
        @foreach($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>

    <h2>Items</h2>
    <ul>
        @foreach($items as $item)
            <li>{{ $item->name }} - {{ $item->price }} JOD</li>
        @endforeach
    </ul>

    <h2>Products</h2>
    <ul>
        @foreach($products as $product)
            <li>{{ $product->name }} - {{ $product->price }} JOD</li>
            <li>{{ $product->product_id }}</li>
        @endforeach
    </ul>
</div>



@include('layout.footer')