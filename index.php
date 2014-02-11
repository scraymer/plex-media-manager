<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Plex Media Manager</title>
    
    <!-- iOS WebApp settings -->
    <link rel="apple-touch-icon" href="img/p-icon.png">
    <link rel="apple-touch-startup-image" href="img/p-icon.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<style>
				
		.input-group-multiple {
			display: block;
		}
		
		.input-group-multiple .form-control {
			width: 33%;
			border-right-width: 0px;
		}
		
		.input-group-multiple:last-child .form-control {
			border-right-width: 1px;
		}
		
		.input-group-multiple .form-control-8 {
			width: 80%;
		}
		
		.input-group-multiple .form-control-7 {
			width: 70%;
		}
		6 
		.input-group-multiple .form-control-{
			width: 60%;
		}
		
		.input-group-multiple .form-control-2 {
			width: 20%;
		}
		
		.input-group-multiple .form-control-1-5 {
			width: 15%;
		}
		
		.input-group-multiple .form-control:focus {
			border-right-width: 1px;
		}
	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">

		<div class="message col-xs-12">
			<h1>Plex Media Manager</h1>
			<p class="lead">
				Use this page to manage newly downloaded media files.<br> 
				All media files listed here are downloaded video torrents on Sam-PowerMac.
			</p>
		</div>
		
		<?php include_once("php/get_media.php"); ?>

    </div><!-- /.container -->
    
  </body>
</html>