@extends('unstarter.layouts.master_bootstrap_simple')

@section('content')

<div class="un_box csch_dark9">

<h1>jQuery & JS Minitools </h1>

</div>

<table class = "table table-striped table-bordered">
  @foreach($object as $o)
    <tr>
                        
                        <td>{{$Feature->name}}</td>
                        
                        <td>{{$Feature->description}}</td>
                        
                        <td>{{$Feature->demonstration_URL}}

                            @includeif('starter.features.'.$Feature->id)

                        </td>
                        
                        
                        <td>
                                <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "unstarter/feature/{{$Feature->id}}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = 'unstarter/feature/{{$Feature->id}}/edit'><i class = 'material-icons'>edit</i></a>
                                <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = 'unstarter/feature/{{$Feature->id}}'><i class = 'material-icons'>info</i></a>
                        </td>
                    </tr>
  @endforeach
</table>
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