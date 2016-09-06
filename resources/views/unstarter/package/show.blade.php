<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Show Package</title>
    </head>
    <body>
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
    </body>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>
