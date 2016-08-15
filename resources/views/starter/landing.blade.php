@extends('starter.layouts.master_bootstrap_simple')



@section('sidebar')
    @parent

    <a href="{{URL::to('feature')}}">Features</a>
@endsection


@section('content')

            <div class="content">
                <div class="title m-b-md">
                    UnrulyNatives Laravel Starter Kit
                </div>

                <div class="links">
                    <a href="{{URL::to('feature')}}">Features</a>
                    <a href="{{URL::to('starter/packages')}}">Packages Included</a>
                    <a href="{{URL::to('starter/frontend')}}">Frontend</a>
                    <a href="{{URL::to('starter/minitools')}}">JS & jQuery minitools</a>
                    <a href="{{URL::to('starter/snippets')}}">Snippets</a>

                    <a href="https://github.com/UnrulyNatives/laravel-starter-and-live-snippets">GitHub</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>
                </div>
            </div>

@stop