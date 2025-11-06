@extends('app')

@section('title', 'Checkout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Checkout</h2>
        
        <div class="card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body">
                @foreach($cartItems as $id => $item)
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-2">
                        @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid" alt="{{ $item['name'] }}" style="height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 60px;">
                                <span class="text-muted">No image</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h6>{{ $item['name'] }}</h6>
                    </div>
                    <div class="col-md-2">
                        <span>${{ number_format($item['price'], 2) }}</span>
                    </div>
                    <div class="col-md-2">
                        <span>Qty: {{ $item['quantity'] }}</span>
                    </div>
                </div>
                @endforeach
                
                <div class="row mt-3">
                    <div class="col-md-12 text-end">
                        <h5>Total: ${{ number_format($total, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Place Order</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address *</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method *</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash on Delivery</option>
                            <option value="card">Credit/Debit Card</option>
                            <option value="bank">Bank Transfer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Place Order</button>
                </form>
                
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">Back to Cart</a>
            </div>
        </div>
    </div>
</div>
@endsection