@extends('app')

@section('title', 'My Orders')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>My Orders</h2>
        
        @if(empty($orders))
        <div class="alert alert-info">
            <p class="mb-0">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">Start Shopping</a>
        </div>
        @else
            <!-- Orders list would go here -->
            <p>Your orders will appear here once you place them.</p>
        @endif
    </div>
</div>
@endsection