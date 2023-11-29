<x-frontend.master>
    <x-slot:title>PRH | Home</x-slot>

    <div class="container">
        @foreach($categories as $category)
            <div class="mt-6">
                <h2 class="text-center">{{ $category->name }}</h2>
                <div id="carousel_{{ $category->id }}" class="carousel slide mt-5">
                    <div class="carousel-inner">
                        @foreach($category->products->chunk(3) as $index => $productsChunk)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row row-cols-1 row-cols-sm-4 g-3">
                                    @foreach($productsChunk as $product)
                                        <div class="col col-sm-4">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{{ $product->image }}" alt="..." />
                                                <div class="card-body p-3">
                                                    <div class="text-center">
                                                        <h5 class="fw-bolder">{{ $product->title }}</h5>
                                                        {{ $product->price }}
                                                    </div>
                                                </div>
                                                <div class="card-footer p-3 pt-0 border-top-0 bg-transparent">
                                                    <div class="text-center">
                                                        <a class="btn btn-outline-dark mt-auto" href="{{ route('product_details', $product->slug)}}">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{ $category->id }}" data-bs-slide="prev" style="width: 5%; left: -5%;">
                        <span class="carousel-control-prev-icon bg-secondary" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{ $category->id }}" data-bs-slide="next" style="width: 5%; right: -5%;">
                        <span class="carousel-control-next-icon bg-secondary" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</x-frontend.master>
