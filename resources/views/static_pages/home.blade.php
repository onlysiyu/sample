@extends('layouts.default')

@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                     @include('shared._status_form')
                </section>
                <h3>weibo list</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                  @include('shared._user_info', ['user' => Auth::user()])
                </section>
                <section class="stats">
                  @include('shared._stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
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
    @endif
stop