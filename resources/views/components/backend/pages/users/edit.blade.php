<x-backend.master>
    <x-slot:title>{{$user->name}} | Edit</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Edit User Info</h3>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary">List</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" name="name" placeholder="User's name" value="{{ $user->name }}" />
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="text" name="email" placeholder="Email" value="{{ $user->email }}" />
                                <label for="email">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="role" name="role">
                                    <option value="1" {{ $user->role->id === '1' ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->role->id === '2' ? 'selected' : '' }}>Moderator</option>
                                    <option value="3" {{ $user->role->id === '3' ? 'selected' : '' }}>User</option>
                                </select>

                                <label for="role">Role</label>
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