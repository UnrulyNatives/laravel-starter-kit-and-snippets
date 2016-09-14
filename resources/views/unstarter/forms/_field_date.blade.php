@unless(isset($label) && $label == 'none') 
        {!! Form::label($fieldname, trans('buttons.'.$fieldlabel)) !!}
@endunless

            <div class="ui  big fluid labeled input">

                @if($purpose == 'create')
                	{!! Form::date($fieldname, Input::old($fieldname), array('class' => @$class, 'placeholder' => @$placeholder)) !!}
                @else
                	{!! Form::date($fieldname, $object->$fieldname, array('class' => @$class, 'placeholder' => @$placeholder)) !!}
                @endif
                

            </div>