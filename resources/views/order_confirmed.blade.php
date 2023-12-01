<x-frontend.master>
    <x-slot name="title">Order Confirmation</x-slot>

    <div class="container mt-4">
        <h2>Your Orders</h2>

        @if($orders->isEmpty())
            <p>No orders found.</p>
        @else
            @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Order ID: {{ $order->id }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>User:</strong> {{ $order->user->name }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>Status:</strong>
                            @if($order->status === 0)
                                Pending
                            @elseif($order->status === 1)
                                Processing
                            @elseif($order->status === 2)
                                Shipped
                            @elseif($order->status === 3)
                                Received
                            @endif
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('welcome') }}" class="btn btn-primary">Back</a>
                        <a href="#" class="btn btn-success">Download Invoice</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-frontend.master>
