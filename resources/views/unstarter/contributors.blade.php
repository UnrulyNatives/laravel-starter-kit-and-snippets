@extends('unstarter.layouts.master_bootstrap_simple')



@section('sidebar')
    @parent

    <a href="{{URL::to('feature')}}">Features</a>
@endsection


@section('content')

            <div class="content">
                <div class="title m-b-md">
                   Contributors
                </div>



                <div class="links">
                    <a href="{{URL::to('unstarter/initial-setup')}}">Initial setup</a>
                    <a href="{{URL::to('unstarter/admin')}}">Admin panel</a>
                    <a href="{{URL::to('dashboard')}}">LTM Admin</a>
                    <a href="{{URL::to('feature')}}">Features</a>
                    <a href="{{URL::to('unstarter/packages')}}">Packages</a>
                    <a href="{{URL::to('unstarter/frontend')}}">Frontend</a>
                    <a href="{{URL::to('unstarter/minitools')}}">JS & jQuery minitools</a>
                    <a href="{{URL::to('unstarter/snippets')}}">Snippets</a>


                </div>
            </div>

@stop