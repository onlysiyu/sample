@extends('layouts.default')
@section('title', 'sign in')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>sign in</h5>
    </div>
    <div class="panel-body">
      @include('shared._errors')

      <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="email">email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="password">password ( <a href="{{ route('password.request') }}">forget password</a> )</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="checkbox">
              <label><input type="checkbox" name="remember">remember me</label>
          </div>

          <button type="submit" class="btn btn-primary"> sign in </button>
      </form>

      <hr>

      <p><a href="{{ route('signup') }}"> sign up now </a></p>
    </div>
  </div>
</div>
@stop