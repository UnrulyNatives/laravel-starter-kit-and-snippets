<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Create User_setting</title>
    </head>
    <body>
        <div class = 'container'>
            <h1>Create User_setting</h1>
            <form method = 'get' action = '{{url("user_setting")}}'>
                <button class = 'btn btn-danger'>User_setting Index</button>
            </form>
            <br>
            <form method = 'POST' action = '{{url("user_setting")}}'>
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                
                <div class="form-group">
                    <label for="user_id">user_id</label>
                    <input id="user_id" name = "user_id" type="text" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="setting_id">setting_id</label>
                    <input id="setting_id" name = "setting_id" type="text" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="notes">notes</label>
                    <input id="notes" name = "notes" type="text" class="form-control">
                </div>
                
                
                <button class = 'btn btn-primary' type ='submit'>Create</button>
            </form>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>
