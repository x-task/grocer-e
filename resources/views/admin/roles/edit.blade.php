<x-admin-master>
    @section('content')
        {{--  Updated Message  --}}
        @if (session()->has('role-updated'))
            <div class="alert alert-success">
                {{ session('role-updated') }}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <h3>Edit role: {{ $role->label }}</h3>
                    <form method="post" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" name="label" class="form-control" id="label" value="{{ $role->label }}">
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
            </div>
        </div>
        {{--  Permission Table  --}}
        <div class="row">
            <div class="col-lg-12">
                @if ($permissions->isNotEmpty())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="permissionsTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Status</th>
                                <th>Id</th>
                                <th>Label</th>
                                <th>Slug</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type = "checkbox"
                                        {{-- We create a for loop to get the user roles and put them
                                            in a var of $user_role --}}
                                        @foreach ($role->permissions as $role_permission)
                                            {{-- We check with an if() that the slug of $user_role and
                                                $role are equal, if they are we check the checkbox --}}
                                            @if ($role_permission->slug == $permission->slug)
                                                checked
                                            @endif
                                        @endforeach>
                                    </td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->label }}</td>
                                    <td>{{ $permission->slug }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                @endif
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
