@unless(!isset($wrapperclass) || $wrapperclass == '') 
@endunless
            <div class="un_forminput {{ @$wrapperclass}}">


    @unless(isset($label) && $label == 'none') 
                <div class="un_fielditem" id="" title=""><i class="fa fa-chain"></i> </div>

    @endunless


        @if($purpose == 'create')
            {!! Form::text($fieldname, Input::old($fieldname), array('class' => @$class, 'placeholder' => 'http://...', 'id' => @$id)) !!}

        @elseif($purpose == 'edit')
            {!! Form::text($fieldname, @$object->$fieldname, array('class' => @$class, 'placeholder' => 'http://...', 'id' => @$id)) !!}


        @endif



            </div>
@unless(!isset($wrapperclass) || $wrapperclass == '') 
@endunless