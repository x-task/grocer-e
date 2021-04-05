<x-admin-master>
    @section('content')
        <h1>User Profile for: {{ $user->name }}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- Image Displayed --}}
                    <div class="mb-4">
                        <img height="150px" width="175px" class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                    </div>
                    {{-- Edit Image --}}
                    <div class="from-group">
                        <input type="file">
                    </div>
                    {{-- Edit user Name --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        value="{{ $user->name }}">
                    </div>
                    {{-- Edit user Email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                        name="email"
                        class="form-control"
                        id="email"
                        value="{{ $user->email }}">
                    </div>
                    {{-- Edit user Password --}}
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password"
                        name="password"
                        class="form-control"
                        id="password">
                    {{-- Password confirmation --}}
                    <div class="form-group">
                        <label for="password-confirmation">Confirm password</label>
                        <input type="password"
                        name="password-confirmation"
                        class="form-control"
                        id="password-confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
