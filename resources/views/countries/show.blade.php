@extends('layouts.app')
@section('content')
    @include('common.success')
    <div class="col-md-3 text-center">
        <div class="box-body box-profile">
            <img class="img-responsive" src="{{ "/images/countries/" . $country->picture }}" alt="User profile picture" style="width: 340px; height: 235px">

            <h3 class="profile-username text-center">{{ $country->name }}</h3>

            <p class="text-muted text-center">{{ $country->iso }}</p>

            {{--<ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                    <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                    <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
            </ul>--}}

            <a href="/countries/{{ $country->id }}/edit" class="btn btn-primary btn-block"><b>Editar</b></a>
        </div>
    </div>
@endsection