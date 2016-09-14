@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


        <div class = 'container'>
            <h1>Package Index</h1>

            <div class="communique-info">
                Descriptions are pasted from the original respective packages.
            </div>
            <form class = 'col s3' method = 'get' action = '{{url("unstarter/package")}}/create'>
                <button class = 'btn btn-primary' type = 'submit'>Create New Package</button>
            </form>
            <br>
            
            <br>
            <table class = "table table-striped table-bordered">
                <thead>
                    
                    <th>name</th>
                    
                    <th>description</th>
                    
                    <th>string_composer</th>
                    
                    
                    <th>actions</th>
                </thead>
                <tbody>
                    @foreach($packages as $Package)
                    <tr>
                        
                        <td>{{$Package->name}}</td>
                        
                        <td>What it does: <strong>{{$Package->description_does_what}}</strong>
                        <p>Description <strong>{{$Package->description}}</strong></p>
                        </td>
                        
                        <td>{{$Package->string_composer}}</td>
                        
                        
                        <td>
                                <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "unstarter/package/{{$Package->id}}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = 'unstarter/package/{{$Package->id}}/edit'><i class = 'material-icons'>edit</i></a>
                                <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = 'unstarter/package/{{$Package->id}}'><i class = 'material-icons'>info</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class = 'AjaxisModal'>
        </div>
    </div>
@stop 



@push('css')

@endpush
@push('scripts_in_tail')
<script> var baseURL = "{{URL::to('/')}}"</script>
<script src = "{{ URL::asset('js/AjaxisBootstrap.js')}}"></script>
<script src = "{{ URL::asset('js/scaffold-interface-js/customA.js')}}"></script>
@endpush       


</html>
