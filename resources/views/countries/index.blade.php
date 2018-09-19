@extends('layouts.app')
@section('title')
    <h1>
        País
        <small>lista de paises</small>
    </h1>
@endsection
@section('content')
    <div class="row">
        @include('common.success')
        @foreach($countries as $country)
            <div class="col-sm-3 card mb-3">
                <div class="card text-center" >
                    <img style="height: 100px; width: 100px; background-color: #efefef; margin-top: 20px;"
                         class="card-img-top rounded-circle mx-auto"
                         src="/images/countries/{{$country->picture}}"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$country->name}}</h5>
                        <h5 class="card-title">{{$country->iso}}</h5>
                        <a href="/countries/{{$country->id}}" class="btn btn-primary">Ver Mas</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection