<x-backend.master>
    <x-slot:title>Purchase requests | {{ auth()->user()->name }}</x-slot>

    <div class="container mt-4">
        <h1 class="mb-4">Pending Purchase Requests</h1>
        @can('create_purchase_request')
            <a href="{{ route('purchaseRequests.create') }}" class="btn btn-primary mb-4">Create Purchase Request</a>
        @endcan

        <div class="card">
            <div class="card-body">
                @if($purchaseRequests->isEmpty())
                    <p>No pending purchase requests found.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Sent By</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseRequests as $purchaseRequest)
                                    <tr>
                                        <td>{{ $purchaseRequest->title }}</td>
                                        <td>{{ $purchaseRequest->createdBy->name }}</td>
                                        <td>
                                            {{ $purchaseRequest->purchaseRequestItem->product_title }} <br>
                                            <b>Quantity :</b> {{ $purchaseRequest->purchaseRequestItem->quantity }}
                                        </td>
                                        <td>
                                            {!! $purchaseRequest->status == 0 ? 'Pending' : 
                                            ($purchaseRequest->status == 1 ? 'Accepted' : 'Rejected')!!}
                                        </td>
                                        <td>
                                            @can('update_purchase_request')
                                                @if($purchaseRequest->status === 0)
                                                    <form method="POST" action="{{ route('purchaseRequests.update', $purchaseRequest) }}" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm" name="status" value="1">Accept</button>
                                                        <button type="submit" class="btn btn-danger btn-sm" name="status" value="2">Reject</button>
                                                    </form>
                                                @endif
                                            @endcan
                                            @can('delete_purchase_request')
                                                @if($purchaseRequest->status !== 1)
                                                    <form method="POST" action="{{ route('purchaseRequests.destroy', $purchaseRequest) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                @endif
                                            @endcan
                                            <a href="{{ route('purchaseRequests.show', $purchaseRequest->id) }}" class="btn btn-primary btn-sm" class="d-inline">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-backend.master>
