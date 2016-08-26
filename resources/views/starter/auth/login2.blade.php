@extends('layouts.app')
@section('content')
    <div class="main-container form">

        @include('layouts.partials.alerts')

        <div class="page-header">
            <h3>Zaloguj się</h3>
        </div>



    <div class="un_flex un_flex_hs p-a-1">
       <div class="panel panel-primary un_flex un_flex_vt  m-a-1">

       <h3 class="panel-heading">{{trans('buttons.login_by_')}} Chiny.pl</h3>

       <div class="panel-body" id="form">


            <form role="form" method="POST" action="{{ url('login2') }}" class="form-vertical " _lpchecked="1">
        

                {!! Form::hidden('returnURL', $returnURL) !!}
                {!! csrf_field() !!}

                    <div class="un_box un_flex un_flex_vt">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-2 control-label">Email / Użytkownik</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" id="email" class="form-control">
                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-2 control-label">{{trans('buttons.password')}}</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="un_flex un_flex_hc un_flex_wrap">
                            <div class="un_margins1">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i>  {{ trans('buttons.login') }}</button>

                                <a href="{{ url('/password/reset') }}" class="btn btn-outline-primary">{{ trans('buttons.reset_password') }}</a>


                            </div>
                            <div class="un_margins1">

                                Nie masz konta?   <a href="{{URL::to('signup')}}" class=""><i class="fa fa-user"></i> {{ trans('buttons.register') }}</a>


                            </div>
                        </div>
                    </div>
                    </form>
                    <hr>

                 
            </div>
        </div>
       <div class="panel panel-primary un_flex un_flex_vc m-a-1">
              <h3 class="panel-heading">{{ trans('buttons.social_login') }}</h3>
            <div class="panel-body flexv">
                <a href="{{URL::to('login/facebook')}}" class="btn btn-block btn-facebook"><i class="fa fa-facebook"></i>{{trans('buttons.login_by_')}} Facebook</a>
                <a href="{{URL::to('login/twitter')}}" class="btn btn-block btn-twitter"><i class="fa fa-twitter"></i>{{trans('buttons.login_by_')}} Twitter</a>
                <a href="{{URL::to('login/google')}}" class="btn btn-block btn-google"><i class="fa fa-google-plus"></i>{{trans('buttons.login_by_')}} Google</a>

            </div>
       </div>
    </div>



    </div>
@stop

@push('css')
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.12.0/bootstrap-social.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/fonts/fontawesome-webfont.ttf">
        {{-- <link rel="stylesheet" href="{{ load_asset('css/main.css') }}"> --}}

    <style type="text/css">

    </style>

@endpush
@push('scripts_in_tail')



@endpush