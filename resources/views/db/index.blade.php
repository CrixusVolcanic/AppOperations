@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
    <h1>
        Bases de datos
        <small>lista de bases de datos</small>
    </h1>
@endsection
@section('content')
    @include('common.success')
    <div class="box">
        <div class="box-body">
            <table id="dataTableDb" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>País</th>
                    <th>Nombre</th>
                    <th>Periodo</th>
                    <th>Intercambio</th>
                    <th>Cant. Registros</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dbs as $db)
                    <tr >
                        <td>{{ $db->country->name }}</td>
                        <td>{{ $db->name }}</td>
                        <td>{{ substr($db->initial_period, 4, 2) . '/' . substr($db->initial_period, 0, 4)
                                . ' - '
                                . substr($db->final_period, 4, 2) . '/' . substr($db->final_period, 0, 4)}}</td>
                        <td>{{ $db->exchange }}</td>
                        <td>{{ $db->num_records }}</td>
                        <td>
                            @if($db->proccesed_date == null)
                                <span class="label label-warning">Pendiente</span>
                            @else
                                <span class="label label-success">Procesada</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="/dbs/{{ $db->id }}/edit">
                                <button class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-success">
                                <i class="fa fa-check-square"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#dataTableDb').DataTable({
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>
@endsection
