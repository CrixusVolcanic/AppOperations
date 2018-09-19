@extends('layouts.app')
@section('title')
    <h1>
        {{  $person->name }}
        <small>Editar</small>
    </h1>
@endsection
@section('content')
    <div class="box box-primary">
        <form method="POST" action="/persons/{{ $person->id }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Ingrese el nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ $person->name }}" required>
                </div>
                <div class="form-group">
                    <label>Seleccione el tipo de persona</label>
                    <select class="form-control" name="id_tp_person">
                        <option value="{{ $person->tp_persons->id }}">{{ $person->tp_persons->name }}</option>
                        @foreach($tpPersons as $tpPerson)
                            @if($tpPerson->id != $person->tp_persons->id)
                                <option value="{{ $tpPerson -> id }}">{{ $tpPerson -> name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Imagen de la persona</label>
                    <input type="file" name="picture">
                </div>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection