@extends('admin.layout')
@section('title','Dashboard')
@section('header-script')
<!----- Add custom scripts here --->
@endsection
@section('content')
<div class="row">
    <div class="tab-content tab-content-basic">
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
            <div class="row">
                @if(!empty($dashboard_list))
                @foreach($dashboard_list as $key=>$val)
                <div class="col-md-2 col-lg-4 grid-margin stretch-card">
                    <div class="card card-rounded" style="background-color:{{$val->menu_color}}">
                        <div class="card-body pb-0">
                            <h4 class="card-title card-title-dash text-white mb-4 no-margin">{{$val->name}}</h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa-solid fa-{{$val->icon}} dash-icon"></i>
                                </div>
                                <div class="col-sm-8">
                                    <div class="status-summary-chart-wrapper pb-4">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class="">
                                                </div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class="">
                                                </div>
                                            </div>
                                        </div>
                                        <canvas id="status-summary" width="298" height="66" style="display: block; width: 298px; height: 66px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<!----- Add custom scripts here --->
@endsection