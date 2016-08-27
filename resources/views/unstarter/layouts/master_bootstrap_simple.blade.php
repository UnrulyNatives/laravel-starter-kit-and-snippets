<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UnrulyNatives Laravel 5.3 Starter Kit & Assorted Solutions</title>

        <!-- Fonts -->
<link href='https://fonts.googleapis.com/css?family=Prompt:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <!-- Styles -->

        <style type="text/css">
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Prompt';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }
            .title {
                font-size: 4rem;
            }
            nav  {
                text-align: right;
            }
            nav > a, .links a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }


        </style>


        @stack('css')


    </head>
    <body>


        @section('sidebar')
       

        <div class=" un_flex un_flex_vt">
            <nav class="m-a-2 p-a-2">


                    <a href="{{URL::to('/')}}">Start</a>
            @show

                    <a href="{{URL::to('contributors')}}">For contributors</a>
                    <a href="http://dev.unrulynatives.com">DEMO on-line</a>
                    <a href="https://github.com/UnrulyNatives/laravel-starter-and-live-snippets">GitHub</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>

                @if(Auth::check())

                    <a href="{{URL::to('dashboard')}}">Dashboard</a>
                    <a href="{{URL::to('unstarter/admin')}}">Admin</a>
                    <a href="{{URL::to('logout')}}">Logout</a>
                @else

                    <a href="{{URL::to('login')}}">Login</a>
                    <a href="{{URL::to('login2')}}" title="Manual, with extra features">Login 2</a>
                    <a href="{{URL::to('register')}}">Register</a>
                @endif
            </nav>








            @yield('content')

        </div>

        <!-- this loads CDNJS or local files depending on environment -->
        @if( \App::environment() == 'local')
            @include('unstarter.layouts.files_local')
            @include('unstarter.layouts.files_local_bootstrap')
            @include('unstarter.layouts.files_local_select2')
        @else
            @include('unstarter.layouts.files_cdnjs')
            @include('unstarter.layouts.files_cdnjs_bootstrap')
            @include('unstarter.layouts.files_cdnjs_select2')
        @endif


        <link rel="stylesheet"  type="text/css" href="{{asset('css/elements_common.css')}}">



        <!-- filling up universal modal   -->
        {!! Html::script('js/minitool_dom_patch.js') !!}
        <!-- // readmore 3 scripts  -->
        {!! Html::script('js/minitool_showhide.js') !!}

        <!-- necessary for judgment boxes Userattitude -->
        {!! Html::script('js/minitool_attitudes.js') !!}

        <!-- used to update option status being changed (theme, basecountry, etc.)  -->
        {!! Html::script('js/laravel-ujs.js') !!}


        {!! Html::script('js/minitool_modal_universal.js') !!}
    </body>
</html>
