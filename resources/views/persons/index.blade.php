@extends('layouts.app')
@section('title')
    <h1>
        Personas
        <small>lista de personas</small>
    </h1>
@endsection
@section('content')
    <div class="row">
        @include('common.success')
        @foreach($persons as $person)
            <div class="col-sm-3 card mb-3">
                <div class="card text-center" >
                    <img style="height: 100px; width: 100px; background-color: #efefef; margin-top: 20px;"
                         class="card-img-top rounded-circle mx-auto"
                         @if($person->picture != null)
                            src="/images/persons/{{$person->picture}}"
                         @else
                            src="/images/persons/userDefault.png"
                         @endif
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$person->name}}</h5>
                        <h5 class="card-title">{{$person->tp_persons->name}}</h5>
                        <a href="/persons/{{$person->id}}" class="btn btn-primary">Ver Mas</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection