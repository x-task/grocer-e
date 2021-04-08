<x-admin-master>
    @section('content')
        <h1>User Profile for: {{ $user->name }}</h1>
        <div  class  = "row">
        <div  class  = "col-sm-6">
        <form method = "post" action = "{{ route('user.profile.update', $user) }}" enctype = "multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- Image Displayed --}}
                    <div class  = "mb-4">
                    <img height = "150px" width = "175px" class = "img-profile rounded-circle" src = "{{ $user->avatar }}">
                    </div>
                    {{-- Edit Image --}}
                    <div   class = "from-group">
                    <input type  = "file" name = "avatar">
                    @error('avatar')
                            <div class = "alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Edit user Username --}}
                    <div   class = "form-group @error('username') is-invalid @enderror">
                    <label for   = "username">Username</label>
                    <input type  = "text"
                           name  = "username"
                           class = "form-control"
                           id    = "username"
                           value = "{{ $user->username }}">
                        @error('username')
                            <div class = "invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Edit user Name --}}
                    <div   class = "form-group">
                    <label for   = "name">Name</label>
                    <input type  = "text"
                           name  = "name"
                           class = "form-control"
                           id    = "name"
                           value = "{{ $user->name }}">
                        @error('name')
                            <div class = "alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Edit user Email --}}
                    <div   class = "form-group">
                    <label for   = "email">Email</label>
                    <input type  = "text"
                           name  = "email"
                           class = "form-control"
                           id    = "email"
                           value = "{{ $user->email }}">
                        @error('email')
                            <div class = "alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Edit user Password --}}
                    <div   class = "form-group">
                    <label for   = "password">New Password</label>
                    <input type  = "password"
                           name  = "password"
                           class = "form-control"
                           id    = "password">
                        @error('password')
                            <div class = "alert alert-danger">{{ $message }}</div>
                        @enderror
                    {{-- Password confirmation --}}
                    <div   class = "form-group">
                    <label for   = "password-confirmation">Confirm password</label>
                    <input type  = "password"
                           name  = "password-confirmation"
                           class = "form-control"
                           id    = "password-confirmation">
                        @error('password-confirmation')
                            <div class = "alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type = "submit" class = "btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
