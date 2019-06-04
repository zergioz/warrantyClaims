<?php 
ini_set("display_errors", 1);


# start session 
session_start();

#necessary files
include("../includes/WarrantyConfig.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Bootply snippet - Bootstrap Landing Page template</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="An example landing page for Bootstrap 3. Uses FontAwesome and Google Fonts API" />
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<!-- CSS code from Bootply.com editor -->
<style type="text/css">
  html,body {
  height:100%;
}

h1 {
  font-family: Arial,sans-serif
  font-size:80px;
  color:#222;
}

.lead {
	color:#222;
}


/* Custom container */
.container-full {
  margin: 0 auto;
  width: 100%;
  min-height:100%;
  background-color:#FFF;
  color:#222;
  overflow:hidden;
}

.container-full a {
  color:#222;
  text-decoration:none;
}

.v-center {
  margin-top:7%;
}
.btn-lg {
    border-radius: 0px;
  }

.form-control {
    height: 40px;
    font-size: 18px;
    border-radius: 0px;
}
.btn-block {
    width: 976px!important;
}
.btn {
    border-radius: 0px!important;
}

</style>
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>
	<div class="container-full">
	      	<div class="row">
		<div class="col-lg-12 text-center v-center">
			       <a href="http://warranty.pdwatersystems.com"> <img src="http://www.pdwatersystems.com/images/Logo.jpg" ></a>
                        <br><br><br>
		</div>
       		<div class="col-lg-12">
			<?php $warranty->ViewMesg();?>
			<!-- include form templates -->
			<?php $warranty->ViewClaimForm();?>
		</div>
		</div>
	</div>
  	<br><br><br><br><br>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
</html>


