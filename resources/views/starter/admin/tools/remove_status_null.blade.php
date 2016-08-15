@extends('starter.layouts.master_bootstrap_simple')

@section('content')


    @include('starter.admin.tools._admintools')
    @include('starter.admin.tools._info_on_perform')


<div class="un_title">
    <h2>This tool allows to delete all models which status field equals to null</h2>

    <p>When needed? When you need to clean up your DB by removing records submitted by spam bots.</p>
    <p>FOr security reasons the tool's code is hard-written would not service fields other than `status`</p>
</div>


@if(!isset($object))
        <div class="communique-info communique-cleared" id="">
            <h4>No model selected!</h4>
            <p>The URL should contain your model name, lowercase, plural (e. `features` for model `Feature`)</p>



        </div>
@else
    <h3 class="un_title">Items matching criteria: {{$object->count() }}.</h3>
@endif

@stop

