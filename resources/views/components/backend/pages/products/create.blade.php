<x-backend.master>
    <x-slot:title>Enlist</x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Enter New Product</h3>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">List</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Category --}}
                            <div class="form-floating mb-3">
                                <select class="form-control" id="category" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="category">Category</label>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="title" type="text" name="title" placeholder="Product title" value="{{ old('title') }}" />
                                <label for="title">Title</label>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="price" type="text" name="price" placeholder="Product Price" value="{{ old('price') }}" />
                                <label for="price">Price</label>
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <label for="img">Product Image</label>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="img" type="file" name="image" />
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="description" name="description" placeholder="Product Description">{{ old('description') }}</textarea>
                                <label for="description">Description</label>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" id="chk" type="checkbox" name="status" value="1" />
                                <label class="form-check-label" for="chk">Is Active</label>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

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
