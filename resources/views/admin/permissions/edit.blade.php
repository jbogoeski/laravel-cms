<x-admin-master>
    @section('content')

        <h1>Edit Permission: {{$permission->name}}</h1>

        @if(session()->has('permission-no-updated'))
            <div class="alert alert-success">
                {{session('permission-no-updated')}}
            </div>
        @endif
        @if(session()->has('permission-updated'))
            <div class="alert alert-success">
                {{session('permission-updated')}}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('permissions.update', $permission->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$permission->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

        
    @endsection
</x-admin-master>