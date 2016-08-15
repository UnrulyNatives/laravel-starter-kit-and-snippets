<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

        <title>{{ $title or 'NiePozwalam'}} - System wspomagania decyzji. Sprawdzaj - decyduj - bojkotuj. NiePozwalam.</title>

        <meta name="keywords" content="">
        @if( isset($object) && $task == 'show')
        <META NAME="description" CONTENT="{{$object->description or ''}} -- Bojkotowanie nigdy nie było łatwiejsze">
        @else
        <META NAME="description" CONTENT="Bojkotowanie nigdy nie było łatwiejsze">
        @endif
        <META name="page-topic" content="Bojkotowanie nigdy nie było łatwiejsze">

        <style type="text/css">
            img.gravatar {width:2rem; height:2rem}
        @include('layouts.abovethefold_index')

        </style>
    </head>

    <body class="tm-background">
        <div class="un_flex un_flex_ht">

            <article class="uk-article">

                {{-- include('segments._beta_excuse') --}}

                @yield('content')
                @yield('swich_type')
            </article>

            @if($itemkind == 'pages' && $task !="landingpage")
            <aside class="">
                @yield('aside')
            </aside>
            @endif

        </div>

        <!--  comments and related  -->
        @if($task == 'show' || $task == 'view')
        @include('segments.section_comments_and_related')

        @elseif($task == 'theselikeme'  )
        @elseif($itemkind == 'report' && isset($question))
        <?php $object = $question ?>
        @include('segments.section_comments_and_related')

        @else
        @include('segments.section_comments_and_related')
        @endif

        @if($task == 'show' || $task == 'report')
        @include('segments.section_qrcode')
        @endif
        @include('layouts._developer_status_box')

        @include('segments.section_footer')

        <!-- this loads CDNJS or local files depending on environment -->
        @if( \App::environment() == 'local')
            @include('layouts.files_local')
            @include('layouts.files_local_uikit')
            @include('layouts.files_local_select2')
        @else
            @include('layouts.files_cdnjs')
            @include('layouts.files_cdnjs_uikit')
            @include('layouts.files_cdnjs_select2')
        @endif
        @if($itemkind == 'show' || $itemkind == 'index')
        @include('layouts.files_cdnjs_select2')
        @endif

        {{-- CSS file common for all themes --}}
        <link rel="stylesheet"  type="text/css" href="{{asset('css/elements_common.css')}}">

        {{-- CSS OVERRIDES FOR BASE THEME (UI-KIT), which name is DELAPAZ --}}
        <link rel="stylesheet" href="{{asset('css/adjustments_uikit.css')}}">


            
        <?php $colortheme = request()->cookie('colorTheme','1'); ?>
        <link rel="stylesheet" class='a' id='colortheme' href="{{asset('css/colortheme_'.$colortheme.'.css')}}">

        <!-- css -->
        @stack('css')
        <!-- ./ css -->

        <!-- filling up universal modal   -->
        {!! Html::script('js/peter_universal_modal_uikit.js') !!}


        <!-- filling up universal modal   -->
        {!! Html::script('js/minitool_dom_patch.js') !!}
        <!-- // readmore 3 scripts  -->
        {!! Html::script('js/minitool_showhide.js') !!}

        <script type="text/javascript">
        (function($) {
            $(document).on('ajax:error', function(xhr, status, error) {
                alert(error); // przydałoby się coś ładniejszego
            });
        })(jQuery);


        </script>


        <!-- necessary for judgment boxes Userattitude -->
        {!! Html::script('js/apply_remote_radio.js') !!}

        <!-- used to update option status being changed (theme, basecountry, etc.)  -->
        {!! Html::script('js/laravel-ujs.js') !!}
        @if($task == 'view' || $task == 'show')
        <script>
                $('.pagination').addClass('uk-pagination');
                $('.uk-pagination').removeClass('pagination');
        </script>
        @endif

        @yield('scripts_in_tail')

        <script>
                    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
                    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
                    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
                    e.src='//www.google-analytics.com/analytics.js';
                    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
                    ga('create','UA-58772342-3');ga('send','pageview');
        </script>

        <!-- Content -->
        @stack('scripts_in_tail')
        <!-- ./ content -->
    </body>
    </html>