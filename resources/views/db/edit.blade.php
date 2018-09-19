@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">
@section('title')
    <h1>
        Bases de datos
        <small>Crear nuevos registros</small>
    </h1>
@endsection
@section('content')
    <div class="box box-primary">
        <form method="POST" action="/dbs/{{ $db->id }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="">Seleccione el país</label>
                    <select name="id_country" class="form-control" required>
                        <option value="{{ $db->country->id }}">{{ $db->country->name }}</option>
                        @foreach($countries as $country)
                            @if($db->country->id != $country->id)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Seleccione el proveedor</label>
                    <select name="id_provider" class="form-control" required>
                        <option value="{{ $db->provider->id }}">{{ $db->provider->name }}</option>
                        @foreach($providers as $provider)
                            @if($db->provider->id != $provider->id)
                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Seleccione el analista encargado</label>
                    <select name="id_analyst" class="form-control" required>
                        <option value="{{ $db->analyst->id }}">{{ $db->analyst->name }}</option>
                        @foreach($analysts as $analyst)
                            @if($db->analyst->id != $analyst->id)
                                <option value="{{ $analyst->id }}">{{ $analyst->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre de la base</label>
                    <input type="text" class="form-control" required name="name" value="{{ $db->name }}">
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" required name="description">{{ $db->description }}</textarea>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Es estadística?</label>
                    <select name="statistical" class="form-control" required>
                        @if($db->statistical == '1')
                            <option value="SI" selected>SI</option>
                            <option value="NO">NO</option>
                        @endif
                        @if($db->statistical == '0')
                            <option value="NO" selected>NO</option>
                            <option value="SI">SI</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Seleccione el intercambio</label>
                    <select name="exchange" class="form-control" required>
                        @if($db->exchange == 'IMPORT')
                            <option value="IMPORT" selected>IMPORT</option>
                            <option value="EXPORT">EXPORT</option>
                        @endif
                        @if($db->exchange == 'EXPORT')
                            <option value="EXPORT" selected>EXPORT</option>
                            <option value="IMPORT">IMPORT</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Seleccione el tipo</label>
                    <select name="type" class="form-control" required>
                        @if($db->type == 'NUEVA')
                            <option value="NUEVA" selected>NUEVA</option>
                            <option value="ACTUALIZACION">ACTUALIZACION</option>
                        @endif
                        @if($db->type == 'ACTUALIZACION')
                            <option value="ACTUALIZACION" selected>ACTUALIZACION</option>
                            <option value="NUEVA">NUEVA</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Número de registros</label>
                    <input type="number" name="num_records" class="form-control" value="{{ $db->num_records }}">
                </div>
                <div class="form-group col-lg-3">
                    <label>Perido Inicial</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'mm/yyyy'" data-mask name="initial_period" required value="{{ substr($db->initial_period, 4, 2)
                                                                                                                                                        . '/'
                                                                                                                                                        . substr($db->initial_period, 0, 4) }}">
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label>Periodo Final</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'mm/yyyy'" data-mask name="final_period" required value="{{ substr($db->final_period, 4, 2)
                                                                                                                                                        . '/'
                                                                                                                                                        . substr($db->final_period, 0, 4) }}">
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label>Llegada de la base</label>
                    <div class='input-group date' id='datetimeLlegada'>
                        <input type='text' class="form-control" name="arrived_date" required value="{{ $db->arrived_date }}"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label>Base procesada y cargada</label>
                    <div class='input-group date' id='datetimeProcesada'>
                        <input type='text' class="form-control" name="proccesed_date" value="{{ $db->proccesed_date }}"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#datemask').inputmask('mm/yyyy', { 'placeholder': 'yyyy-mm' })
            $('[data-mask]').inputmask()
        });
        $(function () {
            $("#datetimeLlegada").datetimepicker({
                format:'YYYY-MM-DD HH:mm:ss'
            });
            $("#datetimeProcesada").datetimepicker({
                useCurrent: false,
                format:'YYYY-MM-DD HH:mm:ss'
            });
            $("#datetimeLlegada").on("dp.change", function (e) {
                $('#datetimeProcesada').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimeProcesada").on("dp.change", function (e) {
                $('#datetimeLlegada').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endsection