<x-backend.master>
	<x-slot:title>Product Trash</x-slot:title>

	<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-1 rounded-lg mt-6">
                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Recycle Bin</h3>
                    <a href="{{route('products.index')}}" class="btn btn-outline-success"><span class="fa fa-list"></span></a>
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
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$product->title}}</td>

                                    <td>
                                        <form method="POST" action="{{ route('products.restore', $product) }}" class="d-inline">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn-sm btn-outline-success"><span class="fa fa-trash-restore"></span></button>
                                        </form>
                                        <form method="POST" action="{{ route('products.delete', $product) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-outline-danger" onclick="return confirm('this will delete the item permanently. Are you sure?')"><span class="fa fa-trash"></span></button>
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