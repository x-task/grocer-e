<x-admin-master>
    @section('content')
        {{--  Updated Message  --}}
        @if (session()->has('permission-updated'))
            <div class="alert alert-success">
                {{ session('permission-updated') }}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <h3>Edit permission: {{ $permission->label }}</h3>
                    <form method="post" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" name="label" class="form-control" id="label" value="{{ $permission->label }}">
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
            </div>
        </div>
        {{--  Permission Table  --}}
        <div class="row">
            <div class="col-lg-12">
                @if ($roles->isNotEmpty())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="rolesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Status</th>
                                <th>Id</th>
                                <th>Label</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <input type = "checkbox"
                                        {{-- We create a for loop to get the user roles and put them
                                            in a var of $user_role --}}
                                        @foreach ($permission->roles as $permission_role)
                                            {{-- We check with an if() that the slug of $user_role and
                                                $role are equal, if they are we check the checkbox --}}
                                            @if ($permission_role->slug == $role->slug)
                                                checked
                                            @endif
                                        @endforeach>
                                    </td>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->label }}</td>
                                    <td>{{ $role->slug }}</td>
                                    <td>
                                        <form action="{{ route('permission.role.attach', $permission) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <button type="submit" class = "btn btn-primary"
                                             {{-- If the Permission role(table in DB) contains this role,
                                                disable this button --}}
                                            @if ($permission->roles->contains($role))
                                                disabled
                                            @endif>Attach</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('permission.role.detach', $permission) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <button type="submit" class = "btn btn-danger"
                                            {{-- If the Permission role(table in DB) contains this role,
                                                disable this button --}}
                                            @if (!$permission->roles->contains($role))
                                                disabled
                                            @endif>Detach</button>
                                        </form>
                                    </td>
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
