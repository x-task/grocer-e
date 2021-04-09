<x-admin-master>
    @section('content')
    <h1>All Users</h1>
    {{-- @if (Session::has('message'))
        <div  class="alert alert-danger">{{Session::get('message')}}</div>
    @elseif (session('post-created-message'))
    <div class="alert alert-success">{{session('post-created-message')}}</div>
    @elseif (session('post-updated-message'))
    <div class="alert alert-success">{{session('post-updated-message')}}</div>
    @endif --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Full Name</th>
                  <th>Avatar</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Delete</th>

                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Delete</th>

                </tr>
              </tfoot>
              <tbody>
              @foreach ($users as $user )
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{ $user->name }}</a></td>
                    <td><div><img height="100px" src="{{$user->avatar}}" alt=""></div></td>
                    <td>{{ $user->email }}</a></td>
                    <td>{{ $user->password }}</a></td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>
                        {{-- @can('view', $user)     {{-- @can is like an if statment with paraneters --}}
                            {{-- fisrt is method view from PostPolicy.php, second the model var --}}
                        <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        {{-- @endcan --}}
                    </td>
                </tr>


                @endforeach
              </tbody>


            </table>
          </div>
        </div>
      </div>

    </div>

{{--  {{ $posts->links('pagination::bootstrap-4') }}  Becaous of Bootstrap 4  --}}
<div class="pagination justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection

@section('scripts')

<!-- Page level plugins -->

<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
{{--  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>  --}}

@endsection

</x-admin-master>
