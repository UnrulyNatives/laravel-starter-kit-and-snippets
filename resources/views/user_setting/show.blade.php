<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Show User_setting</title>
    </head>
    <body>
        <div class = 'container'>
            <h1>Show User_setting</h1>
            <br>
            <form method = 'get' action = '{{url("user_setting")}}'>
                <button class = 'btn btn-primary'>User_setting Index</button>
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
                            <b><i>user_id : </i></b>
                        </td>
                        <td>{{$user_setting->user_id}}</td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b><i>setting_id : </i></b>
                        </td>
                        <td>{{$user_setting->setting_id}}</td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b><i>notes : </i></b>
                        </td>
                        <td>{{$user_setting->notes}}</td>
                    </tr>
                    

                        
                </tbody>
            </table>
        </div>
    </body>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>
