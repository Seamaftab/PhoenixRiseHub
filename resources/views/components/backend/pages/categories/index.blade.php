<x-backend.master>
	<x-slot:title>Categories</x-slot:title>

	<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-1 rounded-lg mt-6">
                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Categories</h3>
                    <a href="{{route('categories.create')}}" class="btn btn-outline-primary">Add New</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                       	<table class="table table-bordered table-striped">
                       		<thead>
                                <tr>
                                    <td style="font-weight: bold;">Sl.</td>
                                    <td style="font-weight: bold;">Title</td>
                                    <td style="font-weight: bold;">Action</td>
                                </tr>
                       		</thead>
                       		<tbody>
                                @php $serial = 1 @endphp
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', ['category' => $category]) }}" class="btn-sm btn-outline-dark"><span class="fa fa-edit"></span></a>
                                        <form method="POST" action="{{ route('categories.destroy', ['category' => $category]) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-outline-danger"><span class="fa fa-trash"></span></button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                       		</tbody>
                       	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend.master>