<!-- theme: Fawkes semantic-ui f:f -->
<div class="un_profile">



        <div class="communique-warning flexh">
   
            <h4 class="Media-title">Wygoda kosztuje.</h4>
            <p>Dodajesz do bazy danych podmiot wpisując tylko jego nazwę - jednak konieczna będzie dodatkowa edycja później. Jeśli wolisz dodać nowy podmiot raz a dobrze, możesz zrobić to  <a href="{{URL::to(trans('routes.entities').'/'.trans('routes.create'))}}" target="_blank" class="btn btn-default">tutaj</a> (nowe okno). </p>
        </div>



    {!! Form::open(array('url' => 'entities/store_ajax', 'method' => 'post', 'class' => 'Demo', 'id' => 'form-quickadd-entities')) !!}


    <div class="Demo">
    <div class="Grid Grid--guttersLg Grid--full med-Grid--fit">
        <div class="Grid-cell">


                {!! Form::text('name', '', array('class' => 'InputAddOn-field', 'placeholder' => trans('buttons.NameCustomary'))) !!}

        </div>

        <div class="Grid-cell">
            {!! Form::hidden('founding_country_id', '', array('id' => 'quickadd_country')) !!}
            {{-- {!! Form::select('new_country', $cou, Input::old('new_country'), array('class'=>'green InputAddOn-field', 'id' => 'select_country')) !!} --}}

             <?php $cou = array('' => 'Kraj...'); ?> 
            {!! Form::select('new_country', $cou, 1, array('class'=>'js-example-placeholder-multiple js-states form-control select2-hidden-accessible', 'id' => 'select_country', 'data-fetchmodel' => 'countries' )) !!}

        </div>


    </div>
    </div>




    {!! Form::close() !!}
    </div>