<x-backend.master>
	<x-slot:title>{{ $user->name }}</x-slot:title>

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-lg-8">
	            <div class="card shadow-lg border-0 rounded-lg mt-5">
	                <div class="card-header">
	                    <h3 class="text-center font-weight-light my-4">{{ $user->name }}'s Details</h3>
	                </div>
	                <div class="card-body">
	                    <div class="row">
	                        <div class="col-md-6">
	                            <h5 class="font-weight-bold">Name:</h5>
	                            <p>{{ $user->name }}</p>
	                            <h5 class="font-weight-bold">Email:</h5>
	                            <p>{{ $user->email }}</p>
	                            <h5 class="font-weight-bold">Role:</h5>
	                            <p>{{ $user->role->name }}</p>
	                    </div>
	                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary mt-4">Back to List</a>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</x-backend.master>