@extends('starter.layouts.master_bootstrap_scaffold')


@section('content')


            <h1>Feature Index:</h1>
            <form class = 'col s3' method = 'get' action = '{{url("feature")}}/create'>
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
                                <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/feature/{{$Feature->id}}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/feature/{{$Feature->id}}/edit'><i class = 'material-icons'>edit</i></a>
                                <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/feature/{{$Feature->id}}'><i class = 'material-icons'>info</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


@stop        