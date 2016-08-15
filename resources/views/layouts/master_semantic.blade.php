<!-- theme: Basic ui-kit tf:b -->
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="Cache-control" content="public">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="Robots" content="index,follow">
        <meta name="revisit-after" content="10 Days">
        <meta name="author" content="UnrulyNatives.com">
        <link rel="shortcut icon" href="/favicon.ico">
        <meta name="distribution" content="global">
        <meta name="classification" content="Culture">
        <meta name="rating" content="general">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keywords" content="">
        @if( isset($object) && $task == 'show')
        <meta name="description" CONTENT="{{$object->description or ''}} -- Bojkotowanie nigdy nie było łatwiejsze">
        @else
        <meta name="description" content="Wykorzystaj do maksimum prawo wolnego wyboru firm i polityków, których usługi i towary kupujesz">
        @endif
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="page-topic" content="NiePozwalam to pamięć internetu i narzędzie wspomagające wolny wybór">
        <title>
        {{@$title}}
        @if($task == 'show')
            {{$object->name}}
        @endif
        NiePozwalam - system wspomagania decyzji
        </title>

        <style type="text/css">
            img.gravatar {
                width:2rem; height:2rem
            }

            @media screen and (max-width: 55.5em) {

                .menu.main .title a span, .him {
                    display: none !important;
                    color: black;
                }
            }

            @if($task == 'landingpage')
                @include('layouts.abovethefold_index')
            @elseif($task == 'create' || $task == 'edit')
                @include('layouts.abovethefold_index')
            @elseif($task == 'index')
                @include('layouts.abovethefold_index')
            @else
                @include('layouts.abovethefold_index')
            @endif

        </style>


        <!-- scripts_in_head -->
        @stack('scripts_in_head')
        <!-- ./ scripts_in_head -->
    </head>
    <body data-show-help-modules="{{ request()->cookie('show-help-modules', '0') }}">

        @if($task == 'create')
        @include('navs._sidebar_create')

        @endif
        @yield('sidebars')

        @include('navs._sidebar_help')
        @include('navs._sidebar_add')
        @include('navs._sidebar_common')
        @include('navs._sidebar_act')
        @include('navs._sidebar_dashboard')



            <?php $active_exemplar_id = request()->cookie('active_exemplar','8'); ?>


        @include('navs._sidebar_exemplars', array('active_exemplar' => \App\Models\Exemplar::find($active_exemplar_id)))

        <div class="pusher">

            <div id="topbar_wrapper">
                <div id="topbar">
                    @include('navs.menu_topbar'.App\Helpers\SitewideHelper::setTopbar())
                </div>
            </div>


            @if(!isset($toolbox)) <?php $toolbox = 1;?> @endif

                <div class="box_toolbox">

                    @if($itemkind != 'pages' && $toolbox != 0 && $itemkind !='users')
                
                        <div class="un_toolbox un_flex un_flex_ht">
                            <button class="ui button blue" data-more="toolbox"> <i class="i-tools icon"></i></button>
                            <div id="toolbox">


                                                    @include('navs._toolbox_object_buttons')
                                                    @yield('toolbox_context_tools')

                            </div>
                        </div>



                    @endif
                </div>


                @yield('content')

                <!--  comments and related  -->
                @if($task == 'show' )
                    @if($itemkind == 'questions' || $itemkind == 'events')

                        @include('segments._box_comments')
                    @elseif($itemkind == 'communiques'  || $itemkind == 'users'|| $itemkind == 'links')
                    @else
                        @include('segments.section_comments_and_related')
                    @endif

                @elseif($task == 'view')
                    @include('segments.section_comments_and_related')
                @elseif($itemkind == 'pages' || $itemkind == 'links')

                @elseif($task == 'theselikeme'  )
                @elseif($itemkind == 'report' && isset($question))
                    <?php $object = $question ?>
                    @include('segments.section_comments_and_related')

                @else
                    @include('segments.section_comments_and_related')
                @endif

                @yield('swich_type')

            

            </div> <!-- #main -->
            </div> <!-- #main-container -->

            @if($task == 'show' || $task == 'report')
                @include('segments.section_qrcode')
            @endif

            @if(Auth::check() && Auth::user()->is('Developer'))
                @include('layouts._developer_status_box')
            @endif

            @include('modals.modal_universal')
            @include('modals.modal_features')
            @include('modals.modal_search')

            @include('segments.section_footer')
        </div>

        <div class="hidden" id="specific_help_modules">
            @yield('view_specific_help_modules')
        </div>

        <!-- this loads CDNJS or local files depending on environment -->
        @if( \App::environment() == 'local')
            @include('layouts.files_local')
            @include('layouts.files_local_semantic')
        @else
            @include('layouts.files_cdnjs')
            @include('layouts.files_cdnjs_semantic')
        @endif

        <link rel="stylesheet"  type="text/css" href="{{asset('css/elements_common.css')}}">
        <link rel="stylesheet"  type="text/css" href="{{asset('css/adjustments_semantic.css')}}">


        <?php $cookie_color_th = request()->cookie('color_th','1'); ?>
        @if(!isset($cookie_color_th)) 
            <?php $cookie_color_th = '1'; ?>
        @endif
        {{Session::put($cookie_color_th)}}



        <link rel="stylesheet" class='a' id='colortheme' href="{{asset('css/colortheme_'.request()->cookie('colorTheme','1').'.css')}}">

        <!-- css yield -->
        @stack('css')
        <!-- ./ css -->

        @if($task == 'show')
            <script type="text/javascript">
                            $("#form_del_item_conf").submit(function (event) {
                            var x = confirm("Are you sure you want to delete?");
                                if (x) {
                                    return true;
                                }
                                else {
                                    event.preventDefault();
                                    return false;
                                }

                            });
            </script>
        @endif

        <!-- This script changes color theme  -->
        {!! Html::script('js/change_theme.js') !!}
        <!-- used to update option status being changed (theme, basecountry, etc.)  -->
        {!! Html::script('js/laravel-ujs.js') !!}

        <!-- action by DOM patch   -->
        {!! Html::script('js/minitool_dom_patch.js') !!}

        <!-- semantic-UI component triggers  -->
        {!! Html::script('js/triggers-semantic-ui.js') !!}

        {!! Html::script('js/triggers-common.js') !!}

        <!-- // readmore 3 scripts  -->
        {!! Html::script('js/minitool_showhide.js') !!}


        <script type="text/javascript">
                (function($) {
                    $(document).on('ajax:error', function(xhr, status, error) {
                        alert(error);
                    });
                })(jQuery);
                // przydałoby się coś ładniejszego
        </script>

        <!-- This script shows hidden IF elements (by Peter) -->
        {!! Html::script('js/minitool_show_hiddenUIelements.js') !!}
        
        <!-- This script hides .communique after X seconds (by Peter) -->
        {!! Html::script('js/peter_hide_communique.js') !!}

        <!-- necessary for judgment boxes Userattitude -->
        {!! Html::script('js/minitool_attitudes.js') !!}

        @stack('scripts_in_tail')

        <script>
                (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
                function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
                e=o.createElement(i);r=o.getElementsByTagName(i)[0];
                e.src='//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
                ga('create','UA-58772342-3');ga('send','pageview');
        </script>

        @if(Auth::check() && Auth::user()->is('Developer'))
        <!--
                {{ print_r(DB::getQueryLog()) }}
        -->
        @endif

    </body>
    </html>