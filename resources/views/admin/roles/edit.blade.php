<x-admin-master>
    @section('content')
        {{--  Updated Message  --}}
        @if (session()->has('role-updated'))
            <div class="alert alert-success">
                {{ session('role-updated') }}
            </div>
        @endif
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
    @endsection
</x-admin-master>
