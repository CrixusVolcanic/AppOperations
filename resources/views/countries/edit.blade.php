@extends('layouts.app')
@section('title')
    <h1>
        {{  $country->name }}
        <small>Editar</small>
    </h1>
@endsection
@section('content')
    <div class="box box-primary">
        <form method="POST" action="/countries/{{ $country->id }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Bandera del país</label>
                    <input type="file" name="picture">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection