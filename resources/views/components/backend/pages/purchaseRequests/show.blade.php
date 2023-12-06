<x-backend.master>
    <x-slot:title>{{ $purchaseRequest->title }}</x-slot>

    <div class="container mt-4">
        <a href="{{ route('purchaseRequests.index') }}" class="btn btn-secondary mb-3">Back</a>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $purchaseRequest->title }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><strong>Status:</strong>
                    {!! $purchaseRequest->status == 0 ? 'Pending' : 
                    ($purchaseRequest->status == 1 ? 'Accepted' : 'Rejected') !!}
                </p>
                <p class="card-text"><strong>Forwarded to:</strong> {{ $purchaseRequest->forward_to }}</p>
                <p class="card-text"><strong>Sent by:</strong> {{ $purchaseRequest->createdBy->name }}</p>
                <p class="card-text"><strong>Note:</strong> {{ $purchaseRequest->note }}</p>
            </div>
        </div>

        <hr>

        <div class="card mt-4">
            @php
                $item = $purchaseRequest->purchaseRequestItem;
            @endphp
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Product: {{ $item->product_title }}
                    <br>
                    Quantity: {{ $item->quantity }}
                    <br>
                    Estimated Cost: ${{ $item->estimated_cost }}
                </li>
            </ul>
        </div>
    </div>
</x-backend.master>
