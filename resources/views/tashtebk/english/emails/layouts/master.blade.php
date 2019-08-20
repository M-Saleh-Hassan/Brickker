<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Brickker</title>
	<link href="https://brickker.com/storage/photos/080520191916575d4880a967c47logo%20english.png" rel="shortcut icon">    	
    
    <!-- css -->
    <style>
        * {margin: 0;padding: 0}
        
        .header {
            height: 75px;
            width: 100%;
            padding:10px;
            text-align: center;
        }
        .header a img {margin: 15px;}
        
        .content {
            min-height: 400px;
            width: 100%;
            background-color: #f9f9f9;
            text-align: center;
        }
        .footer {
            height: 100px;
            width: 100%;
            background-color: #000;
            color: #3fa194;
            text-align: center;
            vertical-align: center;
        }
        .footer p {padding-top: 37px;}
    </style>
    <!-- css -->
</head>

<body>
    <div class="header">
        <a class="navbar-brand" href="{{route('en.home.index')}}" target="_blank">
            <img src="https://brickker.com/storage/photos/080520191916575d4880a967c47logo%20english.png" width="180px" >
        </a>    
    </div>
    
    <div class="content">
          @yield('content')
    </div>
    
    <div class="footer">
        <p>&copy;Copyright 2019 - <strong>Brickker</strong>. All rights reserved.</p>
    </div>
</body>

</html>
