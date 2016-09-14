@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


        <div class = 'container'>
            <h1>Edit Feature</h1>
            <form method = 'get' action = '{{url("unstarter/feature")}}'>
                <button class = 'btn btn-danger'>Feature Index</button>
            </form>
            <br>
            <form method = 'POST' action = '{{url("feature")}}/{{$feature->id}}/update'>
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                
                <div class="form-group">
                    <label for="name">name</label>
                    <input id="name" name = "name" type="text" class="form-control" value="{{$feature->name}}">
                </div>


            {{-- field: featuretype_id --}}
            <?php
            $ftp = array('1' => 'by a package','2' => 'JS/jQuery minitool',);
             ?>
            @include('unstarter.forms._segment_select', array('purpose' => $task, 'fieldname' => 'featuretype_id', 'fieldlabel' => 'featuretype_id','selectarray' => 'ftp','preselected_val' => '', 'icon' => '', 'class' => '' ))

                
                <div class="form-group">
                    <label for="description">description</label>
                    <input id="description" name = "description" type="text" class="form-control" value="{{$feature->description}}">
                </div>


    {{-- field: package_id --}}
    @include('forms._segment_select', array('purpose' => $task, 'fieldname' => 'package_id', 'fieldlabel' => 'package_id','selectarray' => 'pac','preselected_val' => '', 'icon' => '', 'class' => '' ))
                

                
                <div class="form-group">
                    <label for="demonstration_URL">demonstration_URL</label>
                    <input id="demonstration_URL" name = "demonstration_URL" type="text" class="form-control" value="{{$feature->demonstration_URL}}">
                </div>
                
                
                <button class = 'btn btn-primary' type ='submit'>Update</button>
            </form>
        </div>

@stop


@push('css')

@endpush
@push('scripts_in_tail')

@endpush       
