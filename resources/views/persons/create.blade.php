@extends('layouts.app')
@section('title')
    <h1>
        Personas
        <small>Crear persona</small>
    </h1>
@endsection
@include('common.errors')
@section('content')
    <div class="box box-primary">
        <form method="POST" action="/persons" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Ingrese el nombre</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Seleccione el tipo de persona</label>
                    <select class="form-control" name="id_tp_person">
                        @foreach($tpPersons as $tpPerson)
                            <option value="{{ $tpPerson -> id }}">{{ $tpPerson -> name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Imagen de la persona</label>
                    <input type="file" name="picture">
                </div>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection