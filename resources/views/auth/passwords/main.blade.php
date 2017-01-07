<!DOCTYPE html>
<html>
<head>
    <title>Vkluci.MK - Најава</title>
    <link rel="icon" href="images/favicon-32x32.png" sizes="32x32">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/css/app.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        body{
            padding-top: 5%;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col s12 m12 l12">
            <div>
                <div id="grid-container" class="section scrollspy">
                    <!-- Page Content goes here -->
@yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>