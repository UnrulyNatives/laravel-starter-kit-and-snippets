@extends('starter.layouts.master_bootstrap_simple')

@section('content')

<h1>Initial setup</h1>


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
          <h3>2</h3>

          ___


              <a href="{{ URL::to('scaffold') }}" class="ui labeled icon button" target="_blank">
                <i class="linkify icon"></i>
                ___
              </a>
          
          


       </div>
       <div class="">
           
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