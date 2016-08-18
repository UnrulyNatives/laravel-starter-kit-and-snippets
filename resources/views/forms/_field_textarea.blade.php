@unless(isset($fieldlabel) && $fieldlabel == 'none') 
    
    <div class="un_input_label "><i class="fa fa-angle-right icon"></i>_ {{trans('buttons.'.$fieldlabel)}} </div>

@endunless



@unless(!isset($wrapperclass) || $wrapperclass == '') 
    <div class="">
@endunless



    @if($purpose == 'create')
        {!! Form::textarea($fieldname, Input::old($fieldname), array('class' => @$class, 'size' => @$size, 'id' => @$id)) !!}
    @else
        {!! Form::textarea($fieldname, $object->$fieldname, array('class' => @$class, 'size' => @$size, 'id' => @$id, 'placeholder' => @$placeholder)) !!}
    @endif


    @if(isset($icon))
        <div class="btn">
            <i class="{{ @$icon }} icon"></i>
        </div>
    @else
    @endif

@unless(!isset($wrapperclass) || $wrapperclass == '') 
    </div>
@endunless

