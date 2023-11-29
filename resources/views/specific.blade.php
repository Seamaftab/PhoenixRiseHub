<x-frontend.master>
    <x-slot:title>PRH | {{ $category->name }}</x-slot>

    <div class="container">
        <div class="mb-4">
            <h1 class="bg-light p-2">{{ $category->name }} Products</h1>
        </div>
        
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('product_details', $product->slug)}}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            <ul class="pagination pagination-sm">
                {{ $products->links('vendor.pagination.bootstrap-5') }}
            </ul>
        </div>
    </div>
</x-frontend.master>
