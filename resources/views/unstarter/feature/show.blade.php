@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


        <div class = 'container'>
            <h1>Show Feature</h1>
            <br>
            <form method = 'get' action = '{{url("feature")}}'>
                <button class = 'btn btn-primary'>Feature Index</button>
            </form>
            <br>
            <table class = 'table table-bordered'>
                <thead>
                    <th>Key</th>
                    <th>Value</th>
                </thead>
                <tbody>

                    
                    <tr>
                        <td>
                            <b><i>name : </i></b>
                        </td>
                        <td>{{$feature->name}}</td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b><i>description : </i></b>
                        </td>
                        <td>{{$feature->description}}</td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b><i>demonstration_URL : </i></b>
                        </td>
                        <td>{{$feature->demonstration_URL}}</td>
                    </tr>
                    

                        
                </tbody>
            </table>
        </div>
@stop


@push('css')

@endpush
@push('scripts_in_tail')

@endpush       
