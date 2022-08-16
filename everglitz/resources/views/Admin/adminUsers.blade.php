@extends('admin.layout')
@section('title','{{$title}}')
@section('header-script')
<!----- Add custom scripts here --->
@endsection
@section('content')
<!---- Search Div starts here --->
<div style="display:{{$srch_div}}">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Search Informations</h4>
        <form class="forms-sample" role="form" action="{{url('admin/list-admin')}}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">User Name</label>
                <input type="text" name="username" class="form-control" value="{{ $user_name ?? old('user_name')}}" id="exampleInputName1" placeholder="User Name">
                <input type="hidden" name="sr" value="yes">
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">User Type</label>
                <select class="form-select form-control" name="user_type" id="exampleInputName1" aria-label="Default select example">
                  <option value="admin" @if(isset($user_type)) @if("admin"==$user_type ?? old('user_type')) selected="selected" @endif @endif>Admin</option>
                  <option value="staff" @if(isset($user_type)) @if("staff"==$user_type ?? old('user_type')) selected="selected" @endif @endif>Staff</option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Search</button>
          <a href="{{ url('admin/list-admin')}}"><button class="btn btn-light">Cancel</button></a>
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>
<!---- Add Div starts here --->
<div style="display:{{$add_div}}">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Admin Informations</h4>
        <form class="forms-sample" role="form" action="{{ empty($id) ? url('admin/add-admin') : url('admin/update-admin')  }}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">User Name</label>
                <input type="text" name="user_name" class="form-control" value="{{ $user_name ?? old('user_name')}}" id="exampleInputName1" placeholder="User Name">
                <input type="hidden" name="id" value={{$id ?? ''}}>
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">User Type</label>
                <select class="form-select form-control" name="user_type" id="exampleInputName1" aria-label="Default select example">
                  <option value="admin" @if(isset($user_type)) @if("admin"==$user_type ?? old('user_type')) selected="selected" @endif @endif>Admin</option>
                  <option value="staff" @if(isset($user_type)) @if("staff"==$user_type ?? old('user_type')) selected="selected" @endif @endif>Staff</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Password</label>
                (<span class="error" style="color:red;">this will overwrite the current password.If don't need to change password leave it blank</span>)
                <input type="text" class="form-control" value="" id="exampleInputName1" name="password" placeholder="Change Password">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-{{getButton($id ??"")['button_labl']}} me-2">{{getButton($id ??"")['button_sta']}}</button>
          <button class="btn btn-light">Cancel</button>
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>
<!---- List Div starts here --->
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-8">
          <h4 class="card-title cardtitle">{{$title}}</h4>
        </div>
        <div class="col-md-4 menu-button">
          <a href="{{ url('admin/list-admin?add=1')}}">
            <button type="button" class="btn btn-primary btn-icon-text">
              <i class="fa-solid fa-file-lines"></i>
              Add
            </button>
          </a>
          <a href="{{ url('admin/list-admin?search=1')}}">
            <button type="button" class="btn btn-success btn-icon-text">
              <i class="fa-solid fa-filter"></i>
              Search
            </button>
          </a>
          <a href="{{ url('admin/list-admin')}}">
            <button type="button" class="btn btn-warning btn-icon-text">
              <i class="fa-solid fa-arrows-rotate"></i>
              Refresh
            </button>
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>User Name</th>
              <th>User Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($admin_list->count()>0)
            @foreach($admin_list as $key=>$val)
            @if($val->status == "active")
            @php $stat = "success";@endphp
            @else
            @php $stat = "danger";@endphp
            @endif
            <tr>
              <td>{{$val->user_name}}</td>
              <td>{{$val->user_type}}</td>
              <td><a href="{{ url('admin/list-admin?id='.$val->id.'&status='.$val->status.'&page='.$page)}}" class="btn btn-{{$stat}} btn-sm text-white me-0 status-btn"> {{$val->status}}</a></td>
              <td>
                <a href="{{ url('admin/list-admin?edit='.$val->id.'&page='.$page) }}">
                  <button type="button" class="btn btn-sm btn-success btn-icon no-round">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </a>
                <a href="{{ url('admin/delete-admin?id='.$val->id.'&page='.$page) }}" onClick="return confirm('Do you want to delete this user?')">
                  <button type="button" class="btn btn-sm btn-danger btn-icon no-round">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td>
                <h4> ...No result Found .... </h4>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
        <div class="template-demo">
          <div class="btn-group" role="group" aria-label="Basic example">
            @if(!empty(paginate($count)))
            @foreach(paginate($count) as $key=>$val)
            <a href="{{ url('admin/list-admin?page='.$val)}}">
              <button type="button" class="btn btn-outline-secondary @if($val == $page)pagn @endif ">{{$val}}</button>
            </a>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer-script')
<!----- Add custom scripts here --->
@endsection