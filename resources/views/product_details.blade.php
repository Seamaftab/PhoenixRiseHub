<x-frontend.master>
    <x-slot:title>{{$product->title}}</x-slot:title>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                        <h3 class="text-center font-weight-light mb-4">{{$product->title}}'s Details</h3>

                        <div class="text-center mb-4">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <h5 class="font-weight-bold">Category:</h5>
                            <p>{{ $product->category->name }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-weight-bold">Title:</h5>
                            <p>{{ $product->title }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-weight-bold">Price:</h5>
                            <p>{{ $product->price }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-weight-bold">Description:</h5>
                            <p>{{ $product->description }}</p>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('welcome') }}" class="btn btn-outline-dark mb-3">Back</a>
                            <button class="btn btn-outline-dark mb-3" data-bs-toggle="modal" data-bs-target="#addToCartModal"><i class="bi-cart-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BEGINS HERE -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToCartModalLabel">Add to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('carts.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" required>
                        </div>

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL ENDS HERE -->
</x-frontend.master>
