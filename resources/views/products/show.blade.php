@extends('app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}" style="max-height: 500px; object-fit: cover;">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                <span class="text-muted">No image available</span>
            </div>
        @endif
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <span class="badge bg-primary fs-6">{{ $product->brand }}</span>
            <span class="badge bg-secondary fs-6">{{ $product->category }}</span>
        </div>
        
        <h1>{{ $product->name }}</h1>
        
        <div class="mb-3">
            <h3 class="text-primary">${{ number_format($product->price, 2) }}</h3>
            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} fs-6">
                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }} ({{ $product->stock }})
            </span>
        </div>
        
        <div class="mb-4">
            <h5>Description</h5>
            <p>{{ $product->description ?: 'No description available.' }}</p>
        </div>
        
        <div class="d-flex gap-2 mb-4">
            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
            </form>
            @else
            <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
            @endif
            
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-lg">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h6>Product Details</h6>
                <ul class="list-unstyled">
                    <li><strong>Brand:</strong> {{ $product->brand }}</li>
                    <li><strong>Category:</strong> {{ $product->category }}</li>
                    <li><strong>Added:</strong> {{ $product->created_at->format('M d, Y') }}</li>
                    <li><strong>Last Updated:</strong> {{ $product->updated_at->format('M d, Y') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
            <div>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit Product</a>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
            </div>
        </div>
    </div>
</div>
@endsection