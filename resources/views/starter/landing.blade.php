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
     <div class="ui green button">
Current theme: {{ Theme::get() }}</div>
    <p>Przełącz:

        <a href="{{URL::to('set_theme/bootstrap')}}" title="(bootstrap)">
          bootstrap
        </a>
        <a href="{{URL::to('set_theme/semanticui')}}" title="(semanticui)">
          semanticui
        </a>
  </p>


                <div class="links">
                    <a href="{{URL::to('starter/initial-setup')}}">Initial setup</a>
                    <a href="{{URL::to('feature')}}">Features</a>
                    <a href="{{URL::to('starter/packages')}}">Packages</a>
                    <a href="{{URL::to('starter/frontend')}}">Frontend</a>
                    <a href="{{URL::to('starter/minitools')}}">JS & jQuery minitools</a>
                    <a href="{{URL::to('starter/snippets')}}">Snippets</a>

                    <a href="https://github.com/UnrulyNatives/laravel-starter-and-live-snippets">GitHub</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>
                </div>
            </div>

@stop