@extends('unstarter.layouts.master_bootstrap_simple')

@section('content')

<h1>Initial setup</h1>

        <div class="communique-info communique-cleared" id="">
            <h4>Project-specific files and functions</h4>
            <p>Before features of this starter would be moved to a separate apckage, they are developed in separate folders</p>
            <p>Should you want to upgrade your app with the newest features offered by this starter, just copy the following files & folders:

<ol>
    <li>The subfolder `UNStarter` in `App\Http\Controllers`</li>
    <li>The subfolder `unstarter` in `resources\views`</li>
    <li>The file `unstarter.php` in `routes\` (Note: make sure that the file is <strong>still</strong> declared in your `/app/Providers/RouteServiceProvider.php`.</li>
</ol>

            </p>

        

        </div>

    <div class="un_flex un_flex_hs csch_dark9">
       <div class="un_box un_wide20 csch_subtle3">
          <h3>Scaffolding</h3>

          You can quickly create new models and their scaffolding by this 3rd party package:


              <a href="{{ URL::to('scaffold') }}" class="ui labeled icon button" target="_blank">
                <i class="linkify icon"></i>
                scaffold
              </a>
          
          


       </div>
       <div class="un_box un_wide20 csch_subtle3">
          <h3>Variables for your project</h3>

          Check out the file `cache/project-specific.php`. In the file you can define project specific variables. Example: An admin tool for regenerating slugs lists all available models in your app. Check out the below link. You will see the models predefined in the config file.


              <a href="{{ URL::to('unstarter/admintools') }}" class="ui labeled icon button" target="_blank">
                <i class="linkify icon"></i>
                Resluggify minitool
              </a>
          
          


       </div>
       <div class="un_box un_wide20 csch_subtle3">
          <h3>__</h3>

          ___


              <a href="{{ URL::to('scaffold') }}" class="ui labeled icon button" target="_blank">
                <i class="linkify icon"></i>
                ___
              </a>
          
          


       </div>

    </div>




@stop




@push('css')


@endpush


@push('scripts_in_tail')

<script>

    $(document).ready(function(){


        // initializing the tab menu Bootstrap
        $('#tab-nav a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })

        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })


    });
</script>


@endpush        