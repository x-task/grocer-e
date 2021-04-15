<x-admin-master>
    @section('content')
    {{--  Deleted Message  --}}
    @if (session()->has('role-deleted'))
    <div class="alert alert-danger">
        {{ session('role-deleted') }}
    </div>
    @endif
        <div class="row">
            {{--  Creates Role  --}}
            <div class="col-sm-3">
                <form method="post" action="">
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
                      <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="rolesTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Label</th>
                              <th>Slug</th>
                              <th>Delete</th>
                            </tr>
                            {{--  For the for loop to know the $roles we include
                                them in the index() at the RoleController --}}
                          @foreach ($roles as $role )
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->label }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                    <form method="post" action="{{ route('roles.destroy', $role->id) }}">
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
