
@unless(isset($label) && $label == 'none') 
       
<div class="un_input_label "><i class="fa fa-angle-right icon"></i>_ {{trans('buttons.'.$fieldlabel)}} </div>        
@endunless

    @if(isset($icon))

            <div class="p-a-2 csch_subtle3">
               {{--  <div class="btn">
                    <i class="{{ @$icon }} icon"></i>
                </div> --}}
    @else

    <div class="p-a-2 csch_subtle3">
    @endif

         @if($purpose == 'create')
            {!! Form::select($fieldname, ${$selectarray}, @${$preselected_val}, ['class' => '{{ @$class }}']) !!}
        @else
            {!! Form::select($fieldname, ${$selectarray}, $object->$fieldname, ['class' => '{{ @$class }}']) !!}

        @endif



    </div>