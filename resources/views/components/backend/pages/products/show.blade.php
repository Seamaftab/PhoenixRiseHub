<x-backend.master>
    <x-slot:title>{{ $product->title }}</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">{{ $product->title }} Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold">Title:</h5>
                                <p>{{ $product->title }}</p>
                                <h5 class="font-weight-bold">Price:</h5>
                                <p>{{ $product->price }}</p>
                                <h5 class="font-weight-bold">Category:</h5>
                                <p>{{ $product->category->name }}</p>
                                <h5 class="font-weight-bold">Description:</h5>
                                <p>{{ $product->description }}</p>
                                <h5 class="font-weight-bold">Status:</h5>
                                <p>{!! $product->status ? '<i class="fas fa-check text-success"></i> Active' : '<i class="fas fa-times text-danger"></i> Inactive' !!}</p>
                                <h5 class="font-weight-bold">Created By:</h5>
                                <p>{{ $product->createdBy->name }}</p>
                                <h5 class="font-weight-bold">Updated By:</h5>
                                <p>{{ $product->updatedBy->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="font-weight-bold">Image:</h5>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary mt-4">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend.master>
