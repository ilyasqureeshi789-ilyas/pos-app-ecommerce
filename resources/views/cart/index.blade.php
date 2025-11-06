@extends('app')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Shopping Cart</h2>
        
        @if(empty($cartItems))
        <div class="alert alert-info">
            <h4>Your cart is empty!</h4>
            <p class="mb-0">Start adding some products to your cart.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">Browse Products</a>
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $id => $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="{{ $item['name'] }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                <span class="text-muted small">No image</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $item['name'] }}</h6>
                                            <small class="text-muted">${{ number_format($item['price'], 2) }} each</small>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- Decrease Quantity -->
                                        <form action="{{ route('cart.update-quantity', $id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm" {{ $item['quantity'] <= 1 ? 'disabled' : '' }} title="Decrease">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- Quantity Display -->
                                        <span class="badge bg-primary fs-6 px-3">{{ $item['quantity'] }}</span>
                                        
                                        <!-- Increase Quantity -->
                                        <form action="{{ route('cart.update-quantity', $id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm" title="Increase">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- Direct Quantity Input -->
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline ms-2">
                                            @csrf
                                            <div class="input-group input-group-sm" style="width: 120px;">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="form-control form-control-sm">
                                                <button type="submit" class="btn btn-outline-primary btn-sm" title="Update Quantity">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove this item from cart?')" title="Remove Item">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Clear entire cart?')">
                                <i class="fas fa-trash"></i> Clear Cart
                            </button>
                        </form>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('checkout') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-credit-card"></i> Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection