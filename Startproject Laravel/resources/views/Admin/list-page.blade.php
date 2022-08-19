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
        <form class="forms-sample" role="form" action="{{url('admin/list-page')}}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputName1">Title</label>
                <input type="text" name="titlep" class="form-control" value="{{ $titlep ?? old('titlep')}}" id="exampleInputName1" placeholder="Title">
                <input type="hidden" name="sr" value="yes">
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Search</button>
          <a href="{{ url('admin/list-page')}}"><button class="btn btn-light">Cancel</button></a>
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
          <a href="{{ url('admin/add-page')}}">
            <button type="button" class="btn btn-primary btn-icon-text">
              <i class="fa-solid fa-file-lines"></i>
              Add
            </button>
          </a>
          <a href="{{ url('admin/list-page?search=1')}}">
            <button type="button" class="btn btn-success btn-icon-text">
              <i class="fa-solid fa-filter"></i>
              Search
            </button>
          </a>
          <a href="{{ url('admin/list-page')}}">
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
              <th>Title</th>
              <th>Description</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($page_list->count()>0)
            @foreach($page_list as $key=>$val)
            <tr>
              <td>{{$val->title}}</td>
              <td>{{Str::words(($val->description),'3','...') }}</td>
              <td>
                @if($val->image)
                <img class="thumb-image" src="{{ url('thumbnail/'.$val->image) }}">
                @endif
              </td>
              <td>
                <a href="{{ url('admin/update-page?edit='.$val->id.'&page='.$page) }}">
                  <button type="button" class="btn btn-sm btn-success btn-icon no-round">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </a>
                <a href="{{ url('admin/delete-page?id='.$val->id.'&page='.$page) }}" onClick="return confirm('Do you want to delete this Page?')">
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
            <a href="{{ url('admin/list-page?page='.$val)}}">
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