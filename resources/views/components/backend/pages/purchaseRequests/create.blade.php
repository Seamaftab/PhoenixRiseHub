<x-backend.master>
    <x-slot:title>New Request</x-slot:title>

    <div class="container">
        <h1 class="display-5 mb-4">Create Purchase Request</h1>
        <form method="POST" action="{{ route('purchaseRequests.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Note:</label>
                <textarea class="form-control" id="note" name="note" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Select Product:</label>
                <select class="form-select" id="product_id" name="product_id">
                    <option value="">Select Product</option>
                    @foreach($products as $product_id => $product)
                    	<option value="{{$product_id}}">{{$product->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1">
                </div>

                <div class="col-md-6">
                    <label for="estimated_cost" class="form-label">Estimated Cost:</label>
                    <div class="input-group">
                        <span class="input-group-text">&#2547;</span>
                        <input type="number" class="form-control" id="estimated_cost" name="estimated_cost" step="0.01">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</x-backend.master>
