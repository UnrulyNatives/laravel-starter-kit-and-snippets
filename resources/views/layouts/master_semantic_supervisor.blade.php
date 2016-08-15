
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>UN Starter Kit - SUPERVISOR Panel</title>






</head>
<body>


    @include('admin.navs._nav_tools')


<!-- Page Contents -->
<div class="pusher">

@yield('content')

    <!-- this loads CDNJS or local files depending on environment -->
    @if( \App::environment() == 'local')
        @include('layouts.files_local')
        @include('layouts.files_local_select2')
        @include('layouts.files_local_semantic')
    @else
        @include('layouts.files_cdnjs')
        @include('layouts.files_cdnjs_select2')
        @include('layouts.files_cdnjs_semantic')
    @endif

    <link rel="stylesheet"  type="text/css" href="{{asset('css/adjustments_semantic.css')}}">



        <!-- This script changes color theme  -->
        {!! Html::script('js/change_theme.js') !!}
        <!-- used to update option status being changed (theme, basecountry, etc.)  -->
        {!! Html::script('js/laravel-ujs.js') !!}

        <!-- action by DOM patch   -->
        {!! Html::script('js/minitool_dom_patch.js') !!}

        <!-- semantic-UI component triggers  -->
        {!! Html::script('js/triggers-semantic-ui.js') !!}

        {!! Html::script('js/triggers-common.js') !!}

<script type="text/javascript">
    // controls behaviorof the slide toggle
            jQuery( document ).ready( function( $ ) {

                $('[data-more-close]').slideUp();

            } );

            $(function() {
                $('body').on('click','[data-more]', function(e) {
                    e.preventDefault();
                    var target = '#' + $(this).data('more');
                    $(target).slideToggle();
                });

            });
            /* ukryj lub pokaż element*/
            $('[data-showhide]').click(function() {

                var target = $(this).attr("data-showhide");
                // $('#t1_display').text(linkcode);
                $(target).toggleClass('disappear');

            });
    
</script>

</body>

</html>


