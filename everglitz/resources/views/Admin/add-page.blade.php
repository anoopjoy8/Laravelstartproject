@extends('admin.layout')
@section('title','{{$title}}')
@section('header-script')
<link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/summernote-0.8.18-dist/summernote.min.css">
@endsection
@section('content')
<!---- Add Div starts here --->
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"> Add Page</h4>
      <form class="forms-sample" role="form" action="{{ empty($id) ? url('admin/add-page') : url('admin/update-page')  }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputName1">Title</label>
              <input type="text" name="titlep" class="form-control" value="{{ $titlep ?? old('titlep')}}" id="exampleInputName1" placeholder="Title">
              <input type="hidden" name="id" value={{$id ?? ''}}>
              <input type="hidden" name="page" value={{$page ?? ''}}>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputName1">Description</label>
              <textarea id="summernote" name="description"> {{ $description ?? old('description ')}} </textarea>
            </div>
          </div>
          <hr>
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label" for="customFile">Image</label>
                <input type="file" name="main_img" class="form-control form-img" id="customFile" value="{{ $image ?? old('image ')}}" enctype="multipart/form-data" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div id="imgPreview" />
            </div>
          </div>
        </div>
        <hr>
        <div class="col-md-12">
          <div class="form-group">
            <label for="exampleInputName1">Add Sub Images</label>
          </div>
          <div class="col-md-4 sub-img">
            <div class="form-group">
              <div class="field" align="left">
                <input class="form-control form-img" type="file" id="files" name="files[]" value="{{$sub_images ?? ""}}" multiple />
                <span id="image_div">
                  @if(!empty($sub_images))
                  @foreach($sub_images as $key=>$val)
                  @if($val->id!="")
                  <span class="pip"><img src="{{ url('thumbnail/'.$val->image) }}" class="imageThumb" />
                    <br>
                    <span class="removes" onClick="DeleteImage({{$val->id}},{{$val->page_id}})"> <i class="fa-solid fa-trash-can"></i></span>
                  </span>
                  @endif
                  @endforeach
                  @endif
                </span>
              </div>
            </div>
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
@endsection
@section('footer-script')
<script src="{{env('ASSET_URL')}}/admin/summernote-0.8.18-dist/summernote.min.js"></script>
@endsection