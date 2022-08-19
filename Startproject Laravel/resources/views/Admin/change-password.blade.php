@extends('admin.layout')
@section('title','{{$title}}')
@section('content')
<!---- Add Div starts here --->
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Change Password</h4>
            <form class="forms-sample" role="form" action="{{ url('admin/change-password')  }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputName1">Current Password</label>
                            <input type="text" name="pass1" class="form-control" value="{{ $pass1 ?? old('pass1')}}" id="exampleInputName1" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputName1">Repeat Password</label>
                            <input type="text" name="pass2" class="form-control" value="{{ $pass2 ?? old('pass2')}}" id="exampleInputName1" placeholder="Repeat Password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection