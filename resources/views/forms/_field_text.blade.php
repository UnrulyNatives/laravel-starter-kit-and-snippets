@unless(!isset($wrapperclass) || $wrapperclass == '') 
@endunless

<div class="un_forminput {{ @$wrapperclass}}">


    @if(isset($preset_val))
            <?php $preselected = $preset_val; ?>
    @else
        @if(isset(${$preselected_val}))
                <?php $preselected = ${$preselected_val}; ?>
        @else
            <?php $preselected = Input::old($fieldname); ?>
        @endif
    @endif


    <div class="un_fielditem" id="" title="">A... </div>

    @if($purpose == 'create')
        {!! Form::text($fieldname, @$preselected, array('class' => 'InputAddOn-field'.@$class, 'placeholder' => @$placeholder, 'maxlength' => @$maxlength, 'id' => @$id)) !!}
    @else
        {!! Form::text($fieldname, $object->$fieldname, array('class' => 'InputAddOn-field'.@$class,'maxlength' => @$maxlength, 'id' => @$id)) !!}
    @endif


    @if(isset($icon))
        <div class="btn">
            <i class="{{ @$icon }} icon"></i>
        </div>
    @else
    @endif


</div>
@unless(!isset($wrapperclass) || $wrapperclass == '') 
@endunless




