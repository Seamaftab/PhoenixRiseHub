<x-backend.master>
	<x-slot:title>Users</x-slot:title>

	<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-1 rounded-lg mt-6">
                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Users</h3>
                    @can('delete_users')
                    <a href="{{route('users.trash')}}" class="btn btn-outline-dark">Trash</a>
                    </div>
                    @endcan
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
                                    <td style="font-weight: bold;">Name.</td>
                                    <td style="font-weight: bold;">Email</td>
                                    <td style="font-weight: bold;">Role</td>
                                    <td style="font-weight: bold;">Action</td>
                                </tr>
                       		</thead>
                       		<tbody>
                                @php $serial = 1 @endphp
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role->name}}</td>

                                    <td>
                                        <a href="{{ route('users.show', $user) }}" class="btn-sm btn-outline-info"><span class="fa fa-search"></span></a>
                                        @can('update_users')
                                        <a href="{{ route('users.edit', $user) }}" class="btn-sm btn-outline-dark"><span class="fa fa-edit"></span></a>
                                        @endcan
                                        @can('delete_users')
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-outline-secondary"><span class="fa fa-eraser"></span></button>
                                        </form>
                                        @endcan
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
                {{$users->links('vendor.pagination.bootstrap-5')}}
            </ul>
        </div>
    </div>

</x-backend.master>