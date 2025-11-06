@extends('app')

@section('title', 'Products')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>All Products</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        </div>

        <!-- Search and Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($allCategories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="brand" class="form-select">
                                <option value="">All Brands</option>
                                @foreach($allBrands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            @forelse($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 product-card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                            <span class="text-muted">No image</span>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-title mb-0">{{ Str::limit($product->name, 35) }}</h6>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock }}
                            </span>
                        </div>
                        
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $product->brand }}</span>
                            <span class="badge bg-secondary">{{ $product->category }}</span>
                        </div>
                        
                        <p class="card-text flex-grow-1 small text-muted">
                            {{ Str::limit($product->description, 70) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h5>
                            <small class="text-muted">{{ $product->stock }} in stock</small>
                        </div>
                        
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" title="Add to Cart">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn btn-secondary btn-sm" disabled title="Out of Stock">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <h4>No products found!</h4>
                    <p class="mb-0">
                        @if(request('search') || request('category') || request('brand'))
                            Try adjusting your search or filter criteria.
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm ms-2">Clear Filters</a>
                        @else
                            There are no products available at the moment.
                        @endif
                    </p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">Add First Product</a>
                </div>
            </div>
            @endforelse
        </div>

        @if($products->count() > 0)
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
</style>
@endsection