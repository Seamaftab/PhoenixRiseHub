<x-backend.master>
    <x-slot:title>Edit Order</x-slot:title>
    <div class="mt-4 px-4">
    	<a href="{{ route('orders.index') }}" class="btn btn-outline-dark"><span class="fa fa-arrow-left"></span> Back</a>
    </div>
    <div class="container">
    	<div class="card mt-4">
	        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PATCH')
	        	<input type="hidden" name="order_id" value="{{ $order->id }}">
	        	<div class="card-header">
		            <h5 class="card-title">{{ $order->user->name }}  ,Order ID: {{ $order->id }}</h5>
		        </div>
		        <div class="card-body">
		            <div class="mb-3">
		                <label for="userName" class="form-label"><b>User's Name : </b></label>
		                <span id="userName">{{ $order->user->name }}</span>
		            </div>
		            <div class="mb-3">
		                <label for="userPhone" class="form-label"><b>Phone : </b></label>
		                <span id="userPhone">{{ $order->phone }}</span>
		            </div>
		            <div class="mb-3">
		                <label for="userEmail" class="form-label"><b>Email : </b></label>
		                <span id="userEmail">{{ $order->user->email }}</span>
		            </div>
		            <div class="mb-3">
		                <label for="orderProducts" class="form-label"><b>Products : </b></label>
		                <ul id="orderProducts">
		                    @php
		                        $grandTotal = 0;
		                    @endphp
		                    @foreach($order->orderItems as $orderItem)
		                        <li>
		                            <strong>{{ $orderItem->product_title }}</strong> -
		                            Price: {{ $orderItem->price }} - Quantity: {{ $orderItem->quantity }}
		                        </li>
		                        @php
		                            $grandTotal += $orderItem->price * $orderItem->quantity;
		                        @endphp
		                    @endforeach
		                </ul>
		            </div>
		            <div class="mb-3">
		                <label for="orderStatus" class="form-label"><b>Status : </b></label>
		                <select class="form-select" id="orderStatus" name="status">
		                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
		                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processing</option>
		                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Shipped</option>
		                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Received</option>
		                </select>
		            </div>
		            <div class="mb-3">
		                <label for="grandTotal" class="form-label"><b>Grand Total : </b></label>
		                <span id="grandTotal">&#2547;{{ number_format($grandTotal, 2) }}</span>
		            </div>
		        </div>
		        <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update Order</button>
                </div>
	        </form>
	    </div>
    </div>
</x-backend.master>
