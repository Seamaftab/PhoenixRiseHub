<x-backend.master>
    <x-slot:title>{{ $product->title }} | Edit</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">{{$product->title}}</h3>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">List</a>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('failed'))
                        <div class="alert alert-danger">
                            {{ session('failed') }}
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            {{-- Category --}}
                            <div class="form-floating mb-4">
                                <select class="form-select" id="category" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id === $product->category ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="category">Category</label>
                            </div>

                            {{-- Title --}}
                            <div class="form-floating mb-4">
                                <input class="form-control" id="title" type="text" name="title" placeholder="Product title" value="{{ old('title', $product->title) }}" />
                                <label for="title">Title</label>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="form-floating mb-4">
                                <input class="form-control" id="price" type="text" name="price" placeholder="Product Price" value="{{ old('price', $product->price) }}" />
                                <label for="price">Price</label>
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Product Image --}}
                            <label for="image">Product Image</label>
                            <div class="form-floating mb-4">
                                <input class="form-control" id="image" type="file" name="image" />
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="description" name="description" placeholder="Product Description">{{ old('description', $product->description) }}</textarea>
                                <label for="description">Description</label>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="form-check mb-4">
                                <input class="form-check-input" id="status" type="checkbox" name="status" value="1" {{ old('status', $product->status) ? 'checked' : '' }} />
                                <label class="form-check-label" for="status">Is Active</label>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend.master>
