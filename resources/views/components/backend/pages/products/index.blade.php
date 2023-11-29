<x-backend.master>
	<x-slot:title>List</x-slot:title>

	<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-1 rounded-lg mt-6">
                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Product List</h3>
                    <a href="{{route('products.create')}}" class="btn btn-outline-info">Add New</a>
                    @can('delete_product_gate')
                    <a href="{{route('products.trash')}}" class="btn btn-outline-danger"><span class="far fa-trash-alt"></span></a>
                    @endcan
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
                                    <td style="font-weight: bold;">Manufactering Company</td>
                                    <td style="font-weight: bold;">Price</td>
                                    <td style="font-weight: bold;">Status</td>
                                    <td style="font-weight: bold;">Action</td>
                                </tr>
                       		</thead>
                       		<tbody>
                                @php $serial = 1 @endphp
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{ optional($product->category)->name }}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        {!! $product->status ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>' !!}
                                    </td>

                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="btn-sm btn-outline-info"><span class="fa fa-search"></span></a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn-sm btn-outline-dark"><span class="fa fa-edit"></span></a>
                                        {{-- @can('deletion_of_product') --}}
                                            <form method="POST" action="{{route('products.destroy', $product->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm btn-outline-secondary"><span class="fa fa-eraser"></span></button>
                                            </form>
                                        {{-- @endcan --}}
                                    </td>

                                </tr>
                                @endforeach
                       		</tbody>
                       	</table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <ul class="pagination pagination-sm">
                {{$products->links('vendor.pagination.bootstrap-5')}}
            </ul>
        </div>
    </div>

</x-backend.master>