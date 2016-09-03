@extends('unstarter.layouts.master_bootstrap_simple')

@section('content')




@section('sidebar')
    @parent

    <a href="{{URL::to('admin')}}">Admin Dashboard</a>
@endsection




<div class="content un_flex un_flex_vt">
    <h3 class="">
        Admin Tools Dashboard 2
    </h3>

    <div class="un_box links">
        <h3>Assorted tools</h3>
    <a  href="{{URL::to('unstarter/admin/server-status')}}" class="ui button" target="_blank">
    <i class="bar chart icon icon"></i>
    PHP & Server status
    </a>
        
        <a href="{{URL::to('unstarter/admintools/remove-status-null')}}">remove-status-null</a>

        <a href="{{URL::to('unstarter/admintools/user-track')}}">user_track</a>


        <a href="{{URL::to('users')}}" title="powered by spatie/permissions, included in Admin panel in package Amranidev\ScaffoldInterface">assign_roles</a>

        <a href="{{URL::to('unstarter/admintools/regenerate-model-name')}}" title="powered by fabpot/goutte, included in Admin panel in package Amranidev\ScaffoldInterface">regenerate-model-name</a>


    </div>




    <div class="un_box">
    <h3>Resluggify</h3>

    Note: you must manually create a array-type variable with your model names. Preset convention: lowercase plural to target a model. Singular, `Firstletteruppercase` for class name.


    <?php         

    // $sluggable_models = ['features','packages'];
    ?>

   {{-- {{  print_r(config('project_specific.sluggable_models')) }} --}}

        @foreach(config('project_specific.sluggable_models') as $o)
            <a href="{{ URL::to('resluggify/'.$o)}}">{{$o}}</a>
        @endforeach


    </div>






</div>







@stop