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
                                    <th>Note</th>
                                    <th>Status</th>
                                    @can('update_purchase_request')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseRequests as $purchaseRequest)
                                    <tr>
                                        <td>{{ $purchaseRequest->title }}</td>
                                        <td>{{ $purchaseRequest->createdBy->name }}</td>
                                        <td>{{ $purchaseRequest->note }}</td>
                                        <td>
                                            {!! $purchaseRequest->status == 0 ? 'Pending' : 
                                            ($purchaseRequest->status == 1 ? 'Accepted' : 'Rejected')!!}
                                        </td>
                                        @can('update_purchase_request')
                                            <td>
                                                @if($purchaseRequest->status === 0)
                                                    <form method="POST" action="{{ route('purchaseRequests.update', $purchaseRequest->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success" name="status" value="accepted">Accept</button>
                                                        <button type="submit" class="btn btn-danger" name="status" value="rejected">Reject</button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endcan
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
