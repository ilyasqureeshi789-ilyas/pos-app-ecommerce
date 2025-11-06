@extends('app')

@section('title', 'Welcome to SMI Store')

@section('content')
<div class="text-center mb-5">
    <h1 class="fw-bold">Welcome to Ibrahim Store</h1>
    <p class="text-muted">Your one-stop shop for electronics, mobiles, and more.</p>
</div>

@if(isset($categories) && count($categories) > 0)
<div class="row g-4 mb-5">
    <div class="col-12">
        <h3 class="mb-4">Shop by Category</h3>
    </div>
    @foreach($categories as $categoryName => $categoryImage)
    <div class="col-md-3 col-6">
        <div class="card shadow-sm border-0 h-100">
            <img src="{{ $categoryImage }}" class="card-img-top" alt="{{ $categoryName }}" style="height: 200px; object-fit: cover;">
            <div class="card-body text-center d-flex flex-column">
                <h5 class="card-title">{{ $categoryName }}</h5>
                <div class="mt-auto">
                    <a href="{{ route('products.index') }}?category={{ urlencode($categoryName) }}" 
                       class="btn btn-outline-dark btn-sm">
                        Shop Now
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<div class="row g-4">
    <div class="col-12">
        <h3 class="mb-4">Featured Products</h3>
    </div>
    @foreach($featuredProducts as $product)
    <div class="col-md-3 col-6">
        <div class="card shadow-sm border-0 h-100">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <span class="text-muted">No image</span>
                </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h6 class="card-title">{{ Str::limit($product->name, 30) }}</h6>
                <p class="card-text text-success fw-bold mb-2">${{ number_format($product->price, 2) }}</p>
                <div class="mb-2">
                    <span class="badge bg-primary">{{ $product->brand }}</span>
                    <span class="badge bg-secondary">{{ $product->category }}</span>
                </div>
                <div class="mt-auto">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="text-center mt-4">
    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">View All Products</a>
</div>
@else
<div class="alert alert-info text-center">
    <h4>No products available yet!</h4>
    <p class="mb-0">Be the first to add products to the store.</p>
    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">Add First Product</a>
</div>
@endif
@endsection