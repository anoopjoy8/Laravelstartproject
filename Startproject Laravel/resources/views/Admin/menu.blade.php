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
        <form class="forms-sample" role="form" action="{{url('admin/list-menu')}}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Menu Name</label>
                <span class="error" style="color:red;">*</span>
                <input type="text" name="menu_name" class="form-control" value="{{ $name ?? old('name')}}" id="exampleInputName1" placeholder="Menu Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Table Name</label>
                <input type="text" class="form-control" value="{{ $url ?? old('url')}}" id="exampleInputName1" name="table_name" placeholder="Table Name">
                <input type="hidden" name="sr" value="yes">
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Search</button>
          <a href="{{ url('admin/list-menu')}}"><button class="btn btn-light">Cancel</button></a>
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
        <h4 class="card-title"> Menu Informations</h4>
        <form class="forms-sample" role="form" action="{{ empty($id) ? url('admin/add-menu') : url('admin/update-menu')  }}" method="post" enctype="multipart/form-data" id="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Menu Name</label>
                <span class="error" style="color:red;">*</span>
                <input type="text" name="menu_name" class="form-control" value="{{ $name ?? old('name')}}" id="exampleInputName1" placeholder="Menu Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Parent Menu</label>
                <select class="form-select form-control" name="parent_menu" id="exampleInputName1" aria-label="Default select example">
                  <option value="0">None</option>
                  @if(!empty($menu_list))
                  @foreach($menu_list as $key=>$val)
                  <option value="{{$val->id}}" @if(isset($parent_menu)) @if($val->id == $parent_menu ?? old('parent_menu')) selected="selected" @endif @endif>{{$val->name}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Url</label>
                <input type="text" class="form-control" value="{{ $url ?? old('url')}}" id="exampleInputName1" name="url" placeholder="Url">
                <input type="hidden" name="id" value={{$id ?? ''}}>
                <input type="hidden" name="page" value={{$page ?? ''}}>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Active Url</label>
                <span class="error" style="color:red;">(can use multiple url by sepperating with commas)</span>
                <input type="text" class="form-control" value="{{ $active_url ?? old('active_url')}}" id="exampleInputName1" name="active_url" placeholder="Active Url">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Fa-Icon</label>
                <input type="text" class="form-control" value="{{ $icon ?? old('icon')}}" id="exampleInputName1" name="icon" placeholder="file-o">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Menu Order</label>
                <span class="error" style="color:red;">*</span>
                <input type="text" class="form-control" value="{{ $menu_order ?? old('menu_order')}}" id="exampleInputName1" name="menu_order" placeholder="Menu Order">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Table Name</label>
                <input type="text" class="form-control" value="{{ $table_name ?? old('table_name')}}" id="exampleInputName1" name="table_name" placeholder="Dabase Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Color</label>
                <input type="text" class="form-control" value="{{ $color ?? old('color')}}" id="exampleInputName1" name="color" placeholder="Color">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputName1">Show Home</label>
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="set_home" id="membershipRadios1" value="yes" @if(isset($set_home)) @if($set_home=='yes' ?? old('set_home')) checked="checked" @endif @endif>
                        Yes
                        <i class="input-helper"></i></label>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="set_home" id="membershipRadios1" value="no" @if(isset($set_home)) @if($set_home=='no' ?? old('set_home')) checked="checked" @endif @endif>
                        No
                        <i class="input-helper"></i></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-{{getButton($id ??"")['button_labl']}} me-2">{{getButton($id ??"")['button_sta']}}</button>
          <a href="{{ url('admin/list-menu')}}"><button type="button" class="btn btn-light">Cancel</button></a>
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
          <a href="{{ url('admin/list-menu?add=1')}}">
            <button type="button" class="btn btn-primary btn-icon-text">
              <i class="fa-solid fa-file-lines"></i>
              Add
            </button>
          </a>
          <a href="{{ url('admin/list-menu?search=1')}}">
            <button type="button" class="btn btn-success btn-icon-text">
              <i class="fa-solid fa-filter"></i>
              Search
            </button>
          </a>
          <a href="{{ url('admin/list-menu')}}">
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
              <th>Menu Name</th>
              <th>Menu-order</th>
              <th>Icon</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($menu_list))
            @foreach($menu_list as $key=>$val)
            @php
            $sub_menu_results = App\Models\SubMenu::get_sub_list($val->id);
            @endphp
            <tr>
              <td>{{$val->name}}</td>
              <td>{{$val->menu_order}}</td>
              <td><i class="fa-xl fa-solid fa-{{$val->icon}} ic"></i></td>
              <td>
                <a href="{{ url('admin/list-menu?edit='.$val->id.'&page='.$page) }}">
                  <button type="button" class="btn btn-sm btn-success btn-icon no-round">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </a>
                <a href="{{ url('admin/delete-menu?m_id='.$val->id.'&page='.$page) }}" onClick="return confirm('Do you want to delete this menu?')">
                  <button type="button" class="btn btn-sm btn-danger btn-icon no-round">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </a>
              </td>
              @if(!empty($sub_menu_results))
              @foreach($sub_menu_results as $key=>$val)
            <tr class="sub_tr">
              <td>{{$val->name}}</td>
              <td>{{$val->menu_order}}</td>
              <td><i class="fa-xl fa-solid fa-{{$val->icon}} ic"></i></td>
              <td>
                <a href="{{ url('admin/list-menu?edit_s='.$val->id.'&page='.$page) }}">
                  <button type="button" class="btn btn-sm btn-success btn-icon no-round">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </a>
                <a href="{{ url('admin/delete-menu?s_id='.$val->id.'&page='.$page) }}" onClick="return confirm('Do you want to delete this menu?')">
                  <button type="button" class="btn btn-sm btn-danger btn-icon no-round">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </a>
              </td>
            </tr>
            @endforeach
            @endif
            </tr>
            @endforeach
            @endif

          </tbody>
        </table>
        <div class="template-demo">
          <div class="btn-group" role="group" aria-label="Basic example">
            @if(!empty(paginate($count)))
            @foreach(paginate($count) as $key=>$val)
            <a href="{{ url('admin/list-menu?page='.$val)}}">
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