@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


        <div class = 'container'>
            <h1>Show Package</h1>
            <br>
            <form method = 'get' action = '{{url("package")}}'>
                <button class = 'btn btn-primary'>Package Index</button>
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
                        <td>
                        {{$package->name}}
                        
                        URL: {{$package->dashboard_URL}}
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b><i>description : </i></b>
                        </td>
                        <td>
                            {{$package->description}}
                            {{$package->description_does_what}}
                            

                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b><i>string_composer : </i></b>
                        </td>
                        <td>{{$package->string_composer}}
                            {{$package->github_URL}}
                        </td>
                    </tr>
                    

                        
                </tbody>
            </table>
        </div>
@stop


@push('css')

@endpush
@push('scripts_in_tail')

@endpush       
