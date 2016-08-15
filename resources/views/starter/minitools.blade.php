@extends('starter.layouts.master_bootstrap_simple')

@section('content')

<div class="un_box csch_dark9">

<h1>jQuery & JS Minitools </h1>

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