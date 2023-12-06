<x-backend.master>
    <x-slot name="title">Create Stock Record</x-slot>

    <div class="container mt-4">
        <a href="{{ route('src.index') }}" class="btn btn-secondary mb-3">Back</a>

        <div class="card">
            <div class="card-header">
                <h2>Create New Stock Record</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('src.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product ID</label>
                        <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{ $product->id }}" readonly>
                        <input type="text" class="form-control" id="product_id" value="{{ $product->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{$purchaseRequest->purchaseRequestItem->quantity}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Ordered</option>
                            <option value="2">Processing</option>
                            <option value="3">Added</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-backend.master>
