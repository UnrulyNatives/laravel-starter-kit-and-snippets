@extends('unstarter.layouts.master_bootstrap_simple')

@section('content')


    @include('unstarter.admin.tools._admintools')
    @include('unstarter.admin.tools._info_on_perform')


<div class="un_title">
    <h2>This tool fills the field `{{$field2change}}` if it is empty! </h2>

    <p>When needed? When lots of instances of a model has the name empty.</p>
</div>



@if(!isset($class))
        <div class="communique-info communique-cleared" id="">
            <h4>No model selected!</h4>
            <p>The URL should contain your model name, lowercase, plural (e. `features` for model `Feature`)</p>



        </div>
@else
    <div class="csch_dark2">
    <h3 class="un_title">Items matching criteria: {{@$model->count() }}.</h3>

    @if(isset($perform) && $perform == 1)
        Instances to be affected: <strong title="itemstobeacteduponbefore">{{ @$itemstobeacteduponbefore}}</strong> |
        Array acted upon: <strong title="acteduponarray">{{$acteduponarray}}</strong>
    @endif

    <h2>        
        $field2change = {{$field2change}} |
        $matchcontent = {{$matchcontent}} |
        $newcontent = {{$newcontent}}
    </h2>
    </div>
@endif





@stop

