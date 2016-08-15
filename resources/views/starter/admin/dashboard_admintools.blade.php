@extends('starter.layouts.master_bootstrap_simple')

@section('content')




@section('sidebar')
    @parent

    <a href="{{URL::to('admin')}}">Admin Dashboard</a>
@endsection




            <div class="content un_flex un_flex_vt">
                <div class="">
                    Admin Tools Dashboard
                </div>

                <div class="links">
                    <a href="{{URL::to('starter/admintools/remove-status-null')}}">remove-status-null</a>

                    <a href="{{URL::to('starter/admintools/user-track')}}">user_track</a>
                    <a href="{{URL::to('starter/admintools/assign-roles')}}">assign_roles</a>

                </div>








</div>







@stop