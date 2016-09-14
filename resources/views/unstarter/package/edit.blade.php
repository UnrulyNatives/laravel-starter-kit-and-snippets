@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


        <div class = 'container'>
            <h1>Edit Package</h1>
            <form method = 'get' action = '{{url("unstarter/package")}}'>
                <button class = 'btn btn-danger'>Package Index</button>
            </form>
            <br>
            <form method = 'POST' action = '{{url("package")}}/{{$package->id}}/update'>
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                
                <div class="form-group">
                    <label for="name">name</label>
                    <input id="name" name = "name" type="text" class="form-control" value="{{$package->name}}">
                </div>
                
                <div class="form-group">
                    <label for="description">description</label>
                    <input id="description" name = "description" type="text" class="form-control" value="{{$package->description}}">
                </div>
                
                <div class="form-group">
                    <label for="string_composer">string_composer</label>
                    <input id="string_composer" name = "string_composer" type="text" class="form-control" value="{{$package->string_composer}}">
                </div>
                                
                <div class="form-group">
                    <label for="description_does_what">description_does_what</label>
                    <input id="description_does_what" name = "description_does_what" type="text" class="form-control" value="{{$package->description_does_what}}">
                </div>
                                
                <div class="form-group">
                    <label for="dashboard_URL">dashboard_URL</label>
                    <input id="dashboard_URL" name = "dashboard_URL" type="text" class="form-control" value="{{$package->dashboard_URL}}">
                </div>
                                
                <div class="form-group">
                    <label for="github_URL">github_URL</label>
                    <input id="github_URL" name = "github_URL" type="text" class="form-control" value="{{$package->github_URL}}">
                </div>
                
                
                <button class = 'btn btn-primary' type ='submit'>Update</button>
            </form>
        </div>
@stop 



@push('css')

@endpush
@push('scripts_in_tail')

@endpush       