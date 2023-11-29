<x-backend.master>
	<x-slot:title>Add New</x-slot:title>

	<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Enter New Category</h3>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">List</a>
                    </div>
                    <div class="card-body">
                    	
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" name="name" placeholder="Category Name" value="{{ old('name') }}"/>
                                <label for="name">Category Name</label>
                                @error('name')
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