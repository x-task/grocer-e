<x-admin-master>
    @section('content')
    {{--  Deleted Message  --}}
    @if (session()->has('permission-deleted'))
    <div class="alert alert-danger">
        {{ session('permission-deleted') }}
    </div>
    @endif
    <div class="row">
        {{--  Creates Role  --}}
        <div class="col-sm-3">
            <form method="post" action="{{ route('permissions.store') }}">
                @csrf
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" name="label" id="label"
                    class="form-control @error('label') is-invalid @enderror">
                    <div>
                        {{--  Error message  --}}
                        @error('label')
                            <span><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Create</button>
            </form>
        </div>
        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="permissionsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Label</th>
                        <th>Slug</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                        {{--  For the for loop to know the $roles we include
                            them in the index() at the RoleController --}}
                    <tbody>
                    @foreach ($permissions as $permission )
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', $permission->id) }}">{{ $permission->label }}</a>
                            </td>
                            <td>{{ $permission->slug }}</td>
                            <td>
                                <form method="post" action="{{ route('permissions.destroy', $permission->id) }}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
    </div>
    @endsection
</x-admin-master>
