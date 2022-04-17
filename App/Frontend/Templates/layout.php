<!DOCTYPE html>
<html>
  <head>
   	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>
      <?= isset($title) ? $title : 'PUBLEC' ?>
    </title>
        
    <!-- <link rel="stylesheet" href="/css/Envision.css" type="text/css" /> -->
    <link href="/Web/css/bootstrap.min.css" rel="stylesheet">
    
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    
    <div>
   <div class="container-fluid"> 	
      <header class="row" style="background-color: rgba(80,195,5,0.3)">
			<div class="col-lg-12">
						<div class="text-center"><img alt="logo" src="/Web/images/logo2.jpg"></div>
			</div>
      </header>
           		
		<nav class="navbar navbar-default navbar-fixed">
		
		<div class="navbar-header">
     		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="#">Publec</a>
    </div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        <ul class="nav navbar-nav">
	          <?php if ($user->isAuthenticated(TRUE)) { ?>
				<li><a>Fil d'actualité</a></li>
				<li><a href="/mesFichiers.html">Mes fichiers</a></li>
				<li><a>Mes abonnés</a></li>
				<li><a>Mes abonnements</a></li>
				<li><a>Mon compte</a></li>
				<li><a>Rechercher</a></li>
				<li><a href="/disconnection.html">Déconnexion</a></li>
	          <?php } ?>
	        </ul>
	       </div>
		</nav>
      
      <div>
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?= $content ?>
        </section>
      </div>
    
      <footer class="col-md-12"><div class="text-right">Développé par FX</div></footer>
    </div>  
    </div><!-- /.container-fluid -->
  </body>
  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Web/js/bootstrap.min.js"></script>
</html>