@extends('starter.layouts.master_bootstrap_simple')

@section('content')




@section('sidebar')
    @parent

    <a href="{{URL::to('admin')}}">Admin Dashboard</a>
@endsection




<div class="content un_flex un_flex_vt">
    <h3 class="">
        Admin Tools Dashboard
    </h3>

    <div class="un_box links">
        <h3>Assorted tools</h3>
        <a href="{{URL::to('starter/admintools/remove-status-null')}}">remove-status-null</a>

        <a href="{{URL::to('starter/admintools/user-track')}}">user_track</a>


        <a href="{{URL::to('users')}}" title="powered by spatie/permissions, included in Admin panel in package Amranidev\ScaffoldInterface">assign_roles</a>


    </div>




    <div class="un_box">
    <h3>Resluggify</h3>

    Note: you must manually create a arra-type variable with your model names. Preset convention: lowercase plural to target a model, singular, Firstletteruppercase for class name 


    <?php         
    $models = ['questions','entities','capacitytypes','events','actions','counteractions','tactics','exemplars','topics','commodities','ingredients','countries','entitystandpoints','entityrelations']; 
    ?>

    AA{{  $models = config('project_specific.sluggable_models') }}BB


                    <li><a href="{{ URL::to('resluggify/questions')}}">Pytania</a></li>
                    <li><a href="{{ URL::to('resluggify/entities')}}">Podmioty</a></li>
                    <li><a href="{{ URL::to('resluggify/events')}}">Zdarzenia</a></li>
                    <li><a href="{{ URL::to('resluggify/entitystandpoints')}}">Stanowiska</a></li>
                    <li><a href="{{ URL::to('resluggify/entityrelations')}}">Relacje</a></li>
                    <li><a href="{{ URL::to('resluggify/capacitytypes')}}">Capacitytypes</a></li>
                    <li><a href="{{ URL::to('resluggify/actions')}}">Akcje</a></li>
                    <li><a href="{{ URL::to('resluggify/counteractions')}}">Kontrakcje</a></li>
                    <li><a href="{{ URL::to('resluggify/tactics')}}">Taktyki</a></li>
                    <li><a href="{{ URL::to('resluggify/exemplars')}}">Wzorce</a></li>
                    <li><a href="{{ URL::to('resluggify/topics')}}">Tematy</a></li>

    </div>






</div>







@stop