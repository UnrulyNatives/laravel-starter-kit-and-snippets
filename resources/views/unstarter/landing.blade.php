@extends('unstarter.layouts.master_bootstrap_simple')



@section('sidebar')
    @parent

    <a href="{{URL::to('unstarter/feature')}}">Features</a>
@endsection


@section('content')

            <div class="content">
                <div class="title m-b-md">
                    UnrulyNatives Laravel Starter Kit
                </div>
     <div class="ui green button">
Current theme: {{ Theme::get() }}</div>
    <p>Switch theme:

        <a href="{{URL::to('set_theme/bootstrap')}}" title="(bootstrap)">
          bootstrap
        </a>
        <a href="{{URL::to('set_theme/semanticui')}}" title="(semanticui)">
          semanticui
        </a>
  </p>


                <div class="links">
                    <a href="{{URL::to('unstarter/initial-setup')}}">Initial setup</a>
                    <a href="{{URL::to('unstarter/admin')}}">Admin panel</a>
                    <a href="{{URL::to('dashboard')}}">LTM Admin</a>
                    <a href="{{URL::to('unstarter/feature')}}">Features</a>
                    <a href="{{URL::to('unstarter/package')}}">Packages</a>
                    <a href="{{URL::to('unstarter/frontend')}}">Frontend</a>
                    <a href="{{URL::to('unstarter/minitools')}}">JS & jQuery minitools</a>
                    <a href="{{URL::to('unstarter/snippets')}}">Snippets</a>


                </div>
            </div>

@stop