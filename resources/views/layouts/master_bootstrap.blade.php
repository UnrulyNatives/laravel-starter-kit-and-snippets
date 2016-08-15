{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> --}}
    <html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="Cache-control" content="public">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <META name="Robots" content="index,follow">
        <META name="revisit-after" content="10 Days">
        <meta name="author" content="UnrulyNatives.com">
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="distribution" content="global">
        <META name="classification" content="Culture">
        <META name="rating" content="general">

        @if(!isset($itemkind)) <?php $itemkind = 'pages';?> @endif
        @if(!isset($task)) <?php $task = 'view';?> @endif

        <title>{{ $title or 'NiePozwalam'}} - System wspomagania decyzji. Sprawdzaj - decyduj - bojkotuj. NiePozwalam.</title>

        <meta name="keywords" content="">
        @if( isset($object) && $task == 'show')
        <META NAME="description" CONTENT="{{$object->description or ''}} -- Bojkotowanie nigdy nie było łatwiejsze">
        @else
        <META NAME="description" CONTENT="Bojkotowanie nigdy nie było łatwiejsze">
        @endif
        <META name="page-topic" content="Bojkotowanie nigdy nie było łatwiejsze">

        <style type="text/css">

            {{-- @include('layouts._abovethefold_seldon') --}}
            
            img.gravatar {width:2rem; height:2rem}


        </style>



    </head>

    <body class="tm-background Site"  data-show-help-modules="{{ request()->cookie('show-help-modules', '0') }}">


    @yield('communiques')

        @include('navs._navigation_top')

        @if(isset($task) && in_array($task, ['create','show','view','edit']))
            @includeif('navs._toolbox_object')
        @endif


        <!--  Site-content  -->
    <main class=" un_widefull">



                    @if(!isset($toolbox)) <?php $toolbox = 0;?> @endif

                    @if($itemkind != 'pages' && $toolbox != 0)
                        <div class="box_toolbox">

                            {{$toolbox}}
                                <nav class="un_corner2">
                                    @includeif('navs._toolbox_context_object')
                                    @yield('toolbox_context_tools')

                                </nav>
                        </div>
                    @endif

    <div id="more_on_{{$itemkind}}" data-more-close>--</div>
    @yield('content')






        @if($task == 'show' || $task == 'report')
            @include('segments.section_qrcode')
        @endif



        {{-- @include('admin._developer_status_box') --}}

        @include('modals.modal_universal')

{{--         @if(isset($itemkind))
            @include('segments.section_help_for_model', array('itemkind', $itemkind))
        @endif --}}
        @yield('help_modules')

    </main>


{{--         @if($task == 'create' || $task == 'edit')
            @include('segments.section_footer')
        @else
            @include('segments.section_footer')
        @endif
 --}}








        <!-- this loads CDNJS or local files depending on environment -->
        @if( \App::environment() == 'local')
            @include('layouts.files_local')
            @include('layouts.files_local_bootstrap')
            @include('layouts.files_local_select2')
        @else
            @include('layouts.files_cdnjs')
            @include('layouts.files_cdnjs_bootstrap')
            @include('layouts.files_cdnjs_select2')
        @endif



        {{-- CSS OVERRIDES FOR BASE THEME (UI-KIT), which name is DELAPAZ --}}
        {{-- <link rel="stylesheet" href="{{asset('css/solved_by_flexbox.css')}}"> --}}
        <link rel="stylesheet"  type="text/css" href="{{asset('css/elements_common.css')}}">
        <link rel="stylesheet"  type="text/css" href="{{asset('css/adjustments_bootstrap.css')}}">

        {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel=stylesheet> --}}
        <!-- $cookie_colorTheme = request()->cookie('colorTheme','1'); -->
        <?php $cookie_colorTheme = request()->cookie('colorTheme', '1'); ?>
        <link rel="stylesheet" class='a' id='colorTheme' href="{{asset('css/colortheme_'.@$cookie_colorTheme.'.css')}}">

        <!-- css -->
        @stack('css')
        <!-- ./ css -->


        @if($task == 'view' )
        <script>
                $('.pagination li').addClass('page-item');
                $('.pagination li a').addClass('page-link');
                $('.pagination span').addClass('page-link');

        </script>
        @endif

        <script type="text/javascript">
            (function($) {
                $(document).on('ajax:error', function(xhr, status, error) {
                    alert(error); // przydałoby się coś ładniejszego
                });
            })(jQuery);
        </script>

        <!-- filling up universal modal   -->
        {!! Html::script('js/minitool_dom_patch.js') !!}
        <!-- // readmore 3 scripts  -->
        {!! Html::script('js/minitool_showhide.js') !!}

        <!-- necessary for judgment boxes Userattitude -->
        {!! Html::script('js/minitool_attitudes.js') !!}

        <!-- used to update option status being changed (theme, basecountry, etc.)  -->
        {!! Html::script('js/laravel-ujs.js') !!}


        {!! Html::script('js/minitool_modal_universal.js') !!}

        <!-- scripts_in_tail -->
        @stack('scripts_in_tail')
        <!-- ./ scripts_in_tail -->


        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-58772342-3');ga('send','pageview');
        </script>


    </body>
    </html>