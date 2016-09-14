
@unless(Auth::check() && Auth::user()->hasRole('Admin'))

	<div class="ui segment red inverted">
        <h1 class="ui header"> Tylko dla developerów
        <p class="">{{ trans('messages.this_feature_is_for_developers_only') }}</p>

        {!! Html::link('auth/login', trans('buttons.login'), array('class' => 'ui button labeled icon')) !!}

        </h1>
	</div>

@endunless