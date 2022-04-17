<!DOCTYPE html>
<html>
<head>
<title>
<?= isset($title) ? $title : 'PUBLEC' ?>
</title>
    
<meta charset="utf-8" />
    
<link href="/Web/css/designHC.css" rel="stylesheet">
    
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
  
<body>
<div class="container-fluid">

<header class="row" style="background-color: rgba(80,195,5,0.3)">
	<div class="col-md-12">
		<div class="text-center"><img alt="logo" src="/Web/images/logo2.jpg"></div>
	</div>
</header>
 
<div class="row">
	<div class="col-md-1">
		<div class="text-left">
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-th-list"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="/accueil/index.html">Accueil</a></li>
					<li><a href="/accueil/infos-apropos.html">A propos</a></li>
					<li><a href="/accueil/infos-contact.html">Contact</a></li>
					<li><a href="#">FAQ</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="/Web/infos/CGU.pdf">C.G.U.</a></li>
				</ul>
			</div>
		</div>
	</div>  
</div>
      
<div class = "row">
<?php if ($user->hasFlash()) echo '<div class="text-center"><p class="alert alert-info">', $user->getFlash(), '</p></div>'; ?>      
</div>   
      
<?= $content ?>     
    

    
<footer class="row">
<div class="col-md-offset-10 col-md-2"><div class="text-right">Développé par FX</div></div>
</footer>    
</div>	
</body>
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Web/js/bootstrap.min.js"></script>

</html>