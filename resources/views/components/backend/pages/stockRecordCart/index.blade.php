<x-backend.master>
	<x-slot:title>Stock record Cart</x-slot:title>

	<div class="container mt-4">
        <h1 class="mb-4">Stock Records</h1>

        @if(session('error'))
		    <div class="alert alert-danger" role="alert">
		        {{ session('error') }}
		    </div>
		@endif

		@if(session('success'))
		    <div class="alert alert-success" role="success">
		        {{ session('success') }}
		    </div>
		@endif

		<a class="btn btn-outline-primary" href="{{route('src.create')}}">New Cart</a>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">All Stock Records</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($srcRecords as $src)
                                <tr>
                                    <td>{{ $src->id }}</td>
                                    <td>{{ $src->product->title }}</td>
                                    <td>{{ $src->stock }}</td>
                                    <td>{!!
                                    	$src->status == 1 ? 'Ordered' : 
                                        ($src->status == 2 ? 'Processing' : 
                                    	($src->status == 3 ? 'Added' : 'unknown state'))!!}
                                   	</td>
                                   	<td>
                                   		<a href="#" class="btn btn-sm btn-outline-primary">Show</a>
                                   		<a href="#" class="btn btn-sm btn-outline-info">Edit</a>
                                   		<a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                   	</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
</x-backend.master>