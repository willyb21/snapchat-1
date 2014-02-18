<!DOCTYPE html>

<html lang="en">
  <head>
    <meta name="verifyownership" content="0cf7da196285e5d4e3e948f56b2a7272" />
    <title>Snapchat Online</title>
    <meta name="google-site-verification" content="fzkdpXR6Jw0eXhT5EyEazjJJHjHPtGYnpeW_CB4Qm5U" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Login Snapchat Online to save and share your snaps and stories online from your computer without the sender knowing.">
    <meta charset="utf-8"> 
    <link rel="icon" type="image/png" href="imgs/fav.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/extra.css" rel="stylesheet">
    <script src="/js/webcam.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  		<div class="container">
  			<div class="navbar-header">
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  					<span class="sr-only">Toggle navigation</span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  				<a class="navbar-brand" href="/">Snapchat</a>
  			</div>
  			<div class="collapse navbar-collapse">
  				<ul class="nav navbar-nav navbar-right">
            <li><a href="/blog"><span class="glyphicon glyphicon-flash"></span> Blog</a></li> 
            <li><a href="/friends"><span class="glyphicon glyphicon-user"></span> Friends</a></li> 
  					<li><a href="/send"><span class="glyphicon glyphicon-upload"></span> Send From Computer</a></li>  					
  					<li><a href="/faq"><span class="glyphicon glyphicon-question-sign"></span>   Help</a></li>
            <?php if (Session::get('auth') == false): ?> 
  					  <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php else: ?>
              <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php endif; ?>
  				</ul>
  			</div>
  		</div>
  	</div>

