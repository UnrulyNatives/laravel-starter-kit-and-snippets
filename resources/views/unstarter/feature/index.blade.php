@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


            <h1>Feature Index:</h1>
            <form class = 'col s3' method = 'get' action = '{{url("unstarter/feature")}}/create'>
                <button class = 'btn btn-primary' type = 'submit'>Create New Feature</button>
            </form>
            <br>
            
            <br>
            <table class = "table table-striped table-bordered">
                <thead>
                    
                    <th>name</th>
                    
                    <th>description</th>
                    
                    <th>demonstration_URL</th>
                    
                    
                    <th>actions</th>
                </thead>
                <tbody>
                    @foreach($features as $Feature)
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
                </tbody>
            </table>


@stop 



@push('css')
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

@endpush
@push('scripts_in_tail')

{!! Html::script('js/select2.min.js') !!}
{!! Html::script('js/select2_language_pl.js') !!}

    <script>
$(document).ready(function() {

    $("select:not([get-byajax])").select2();
    $("select[get-byajax-entities]").select2({

        // var baseurl = "{{URL::to('get_by_ajax/')}}";
        // var itemkind = $(this).attr("get-byajax");
        // var readyurl = baseurl + '/' + itemkind;

    ajax: {
        url: "{{URL::to('get_by_ajax/Entity')}}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return {
            q: params.term
        };
        },
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    escapeMarkup: function (markup) {return markup; }, // let our custom formatter work
    minimumInputLength: 4
    });


});

});
    </script>

@endpush       