@extends('starter.layouts.master_bootstrap_simple')



@section('sidebar')
    @parent

    <a href="{{URL::to('starter/admintools')}}">Admin Tools</a>
@endsection




@section('content')

            <div class="content un_flex un_flex_vt">
                <div class="">
                    Admin Dashboard
                </div>

                <div class="links">
                    <a href="{{URL::to('unstarter/admintools')}}">Admin Tools</a>
                    <a href="{{URL::to('unstarter/frontend')}}">Frontend</a>
                    <a href="{{URL::to('unstarter/packages')}}">Packages Included</a>
                    <a href="{{URL::to('unstarter/minitools')}}">JS & jQuery minitools</a>
                    <a href="{{URL::to('unstarter/snippets')}}">Snippets</a>
                    <a href="{{URL::to('unstarter/admin')}}">Admin</a>
                    <a href="https://github.com/UnrulyNatives/laravel-starter-and-live-snippets">GitHub</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>
                </div>



    <div class="flexh" id="">
       <article class="" id="placeholder_main">
           
@foreach ($object as $o)

<div class="ui segment blue inverted">
<p>{{ $o->id }}: {{ $o->name }}</p>
<p>Ilość tematów:  | Użytkownicy: widzący wszystkie tematy:  | Śledź aktywność: 


    <a href="{{ URL::to('user-track/'.$o->id) }}" class="ui labeled icon button" target="_blank">
      <i class="linkify icon"></i>
      Śledź aktywność
    </a>


</p>


</div>
@endforeach

       </article>
       <aside class="">
           Przejdź do: 



       </aside>
    </div>




</div>


@stop