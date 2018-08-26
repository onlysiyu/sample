@extends('layouts.default')
@section('title', 'user list')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <h1>user list</h1>
  <ul class="users">
    @foreach ($users as $user)
      @include('users._user')
    @endforeach
  </ul>

  {!! $users->render() !!}
</div>
@stop