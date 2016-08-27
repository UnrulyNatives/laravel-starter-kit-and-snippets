
@if(Auth::check())


<div class="un_flex un_flex_ht csch_dark4 m-a-1">
    
    <div class="">
        
        <p>`The function in App\User.php`: <img src="{{URL::to(Auth::user()->gravatar)}}">

        {{URL::to(Auth::user()->gravatar)}}</p>
    </div>
    <div class="">
      <p>  `The function in `Unrulynatives package`: <img src="{{URL::to(Auth::user()->gravatarnew)}}">
    {{URL::to(Auth::user()->gravatarnew)}}
      </p>
        
    </div>

</div>

@else

        <div class="communique-info communique-cleared" id="">
            <h4>Please sign in</h4>
            <p>to see your own Gravatar in action. Now you see gravatar of this package's creator</p>

            <?php $user = \App\User::find(1); ?>
            <img src="{{URL::to($user->gravatarnew)}}">

        </div>
@endif