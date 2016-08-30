{!! Form::label($fieldname, trans('buttons.'.$fieldlabel)) !!}
 <div class="ui big fluid input">

    @if($purpose == 'create')
        {!! Form::file($fieldname) !!}
    @else
        {!! Form::text($fieldname, @$object->$fieldname) !!}
    @endif

    </div>




