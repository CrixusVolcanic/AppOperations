@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ 'plugins/Ionicons/css/ionicons.min.css' }}">
@endsection
@section('title')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
@endsection
@section('content')
    <div class="">
        <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Filtros
                    <i class="fa fa-filter"></i>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" onclick="fnResetFlt()">
                        <i class="fa fa-repeat"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-header bg-info">
                            <h3 class="box-title">Producto</h3>
                            <i class="pull-right fa fa-building"></i>
                        </div>
                        <div class="box-body">
                            <select id="fltProduct" multiple="" class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-header bg-info">
                            <h3 class="box-title">Año</h3>
                            <i class="pull-right fa fa-calendar"></i>
                        </div>
                        <div class="box-body">
                            <select id="fltYear" multiple="" class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-header bg-info">
                            <h3 class="box-title">Mes</h3>
                            <i class="pull-right fa fa-calendar-o"></i>
                        </div>
                        <div class="box-body">
                            <select id="fltMonth" multiple="" class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-header bg-info">
                            <h3 class="box-title">País</h3>
                            <i class="pull-right fa fa-globe"></i>
                        </div>
                        <div class="box-body">
                            <select id="fltCountry" multiple="" class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="dbArrived"></h3>
                    <p>Bases que han llegado</p>
                </div>
                <div class="icon">
                    <i class="fa fa-database"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="dbProcessed"></h3>
                    <p>Bases procesadas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-thumbs-up"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 id="dbInProgress"></h3>
                    <p>Bases en progreso</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cogs"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-light-blue">
                <div class="inner">
                    <h3 id="prEfficiency"></h3>
                    <p>Porcentaje de eficiencia</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tag"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="gphCountryMaxMonth" class="col-lg-12"></div>
        </div>
        <div class="clearfix"></div><br>
        <div class="col-lg-12">
	    <div id="gphCantDbMonth" class="col-lg-6"></div>
            <div id="gphTopAnalyst" class="col-lg-6"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ 'js/dashboard.js' }}"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
@endsection
