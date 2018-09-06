@extends('layouts.app')
@section('title')
    <h1>
        Tipo de personas
    </h1>
@endsection
@section('content')
    <div class="row">
        @include('common.success')
        @include('common.errors')
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 250px">Tipo</th>
                        <th>Descripción</th>
                    </tr>
                    @foreach($tp_persons as $tp_person)
                        <tr>
                            <td>{{ $tp_person->id }}</td>
                            <td>{{ $tp_person->name }}</td>
                            <td>{{ $tp_person->description }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <form method="POST" action="/tp_persons">
                            @csrf
                            <td></td>
                            <td>
                                <input type="text" class="form-control" name="name" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="description" required>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection