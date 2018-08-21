@extends('layouts.default')

@section('content')
  <div class="jumbotron">
    <h1>Halo</h1>
    <p class="lead">
      welcome to <a href="{{ route('home') }}">Rabbits🐇 Planet</a>
    </p>
    <p>
      let's start ~
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">sign up</a>
    </p>
  </div>
@stop