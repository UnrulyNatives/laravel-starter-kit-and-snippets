<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">

    <title>Admin tools</title>

    


<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">







  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="{{URL::to('css/layouts/side-menu.css')}}">
    <!--<![endif]-->
  


    

    

</head>
<body>






<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="#">Admin Tools</a>

            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="#" class="pure-menu-link">Home</a></li>
                @include('starter.admin.tools._admintools')
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>Admin tools</h1>
            <h2>...</h2>
        </div>

        <div class="content">
            <h2 class="content-subhead">A tool for tracking user activity</h2>
            

        <div class="communique-info communique-cleared" id="">
            <h4>Simple example</h4>
            <p>
                Just put this line in your controller method:       <code> activity()->log('Feature index opened'); // spatie activity-log</code>
            </p>

        // success info warning danger cleared dark sm lg // communique-flex

        </div>

                <h1>user_track</h1>

                <h2>
                {{$object->name}}
                </h2>
                {{$object->activity->count()}}


<table class="pure-table">
    <thead>
        <tr>
            <th>#</th>
            <th title="log_name">Activity type</th>
            <th>Activity Description</th>
            <th>when</th>
        </tr>
    </thead>

    <tbody>




                @foreach($object->activity as $o)

        <tr>
            <td>1</td>
            <td>{{$o->log_name}}</td>
            <td>{{$o->description}}</td>
            <td title="{{$o->created_at}}">{{dateHelper::dateDfh($o->created_at)}}</td>
        </tr>

                    
                    
                    
                @endforeach
    </tbody>
</table>



        </div>
    </div>
</div>





<script src="js/ui.js"></script>


</body>
</html>



