@extends('starter.layouts.master')

@section('content')


    @include('starter.admin.tools._info_on_perform')

<hr>
Items matching criteria: {{$object->count()}}.


@stop

