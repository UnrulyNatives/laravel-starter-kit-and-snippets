@extends('layouts.master_bootstrap')
@section('content')

<div class="un_flex un_flex_ht csch_dark4 m-a-1">
    
    <p>`The function in App\User.php`: <img src="{{URL::to(Auth::user()->gravatar)}}">

    {{URL::to(Auth::user()->gravatar)}}</p>
<div class="">
    
</div>
<div class="">
  <p>  `The function in `Unrulynatives package`: <img src="{{URL::to(Auth::user()->gravatarnew)}}">
{{URL::to(Auth::user()->gravatarnew)}}
  </p>
    
</div>

</div>

@stop