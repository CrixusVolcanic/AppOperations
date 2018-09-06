@extends('layouts.app')
@section('content')
    @include('common.success')
    <div class="col-md-3 text-center">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ "/images/persons/" . $person->picture }}" alt="User profile picture" style="width: 340px; height: 235px">
            <h3 class="profile-username text-center">{{ $person->name }}</h3>
            <p class="text-muted text-center">{{ $person->tp_persons->name }}</p>
            <a href="/persons/{{ $person->id }}/edit" class="btn btn-primary btn-block"><b>Editar</b></a>
        </div>
    </div>
@endsection