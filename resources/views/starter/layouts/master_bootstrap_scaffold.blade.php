<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Index Feature</title>
    </head>
    <body>
        <div class = 'container'>



        @yield('content')


    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class = 'AjaxisModal'>
        </div>
    </div>
</body>



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


        <link rel="stylesheet"  type="text/css" href="{{asset('css/elements_common.css')}}">





<script> var baseURL = "{{URL::to('/')}}"</script>
<script src = "{{ URL::asset('js/AjaxisBootstrap.js')}}"></script>
<script src = "{{ URL::asset('js/scaffold-interface-js/customA.js')}}"></script>
</html>
