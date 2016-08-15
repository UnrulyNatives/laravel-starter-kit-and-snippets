@extends('starter.layouts.master')

@section('content')


    @include('starter.admin.tools._info_on_perform')

<hr>

@if(isset($users))
@foreach($users as $u)

    <div class="un_object un_flex un_flex_ht csch_dark4">
        <div class=""> 
        {{$u->name}}</div>
        <div>
        Owned roles: {{ $u->hasAnyRole(Spatie\Permission\Models\Role::all())}}

        {{$granted = $u->roles()->pluck('name')}}

        @foreach($granted as $ngr)
            <button data-load="{{URL::to('starter/admintools/assign-roles/'.$u->id.'/'.$ngr)}}" class='ui button  tt' data-puthere="#u{{$u->id}}_r{{$ngr}}_ungrant" title='______' id="u{{$u->id}}_r{{$ngr}}_ungrant"><i class="text file outline icon"></i>Grant {{$ngr}}</button>
        @endforeach

        <?php
        $allroles = Spatie\Permission\Models\Role::pluck('name');
        $notgranted = $allroles->diff($granted);
        $notgranted->all();
        ?>
        <hr>
        Not granted: 
        @foreach($notgranted as $ngr)
            <button data-load="{{URL::to('starter/admintools/assign-roles/'.$u->id.'/'.$ngr)}}" class='ui button  tt' data-puthere="#u{{$u->id}}_r{{$ngr}}" title='______' id="u{{$u->id}}_r{{$ngr}}"><i class="text file outline icon"></i>Grant {{$ngr}}</button>
        @endforeach
        <div class="" id="test">-</div>
    </div>
</div>

@endforeach
@endif

@stop

