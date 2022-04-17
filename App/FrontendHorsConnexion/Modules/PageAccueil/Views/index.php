<?php
?>
<div class="col-md-12">
	<p style="font-size: 125px; color: rgba(120,202,200,0)">Publec</p>
</div>

<div class="row">
	<div class="col-md-offset-2 col-md-3" style="background-color: rgba(255,255,255,0.5)">
		<h1>Bienvenue<br><small>Partagez vos idées, vos passions, votre imaginaire !</small></h1>
		
	</div>

	<div class="col-md-offset-2 col-md-3" style="background-color: rgba(255,255,255,0.5)">
		<h2>Connexion</h2>
		<form method="post" action="">
			<input type="hidden" name="formConnexion" ></input>
			<div class="form-group">
			    <label for="email">Adresse e-mail </label>
			    <input type="email" name="email" class="form-control" value="<?php if (isset($emailReqLog)) {echo $emailReqLog;}?>"></input>
			    	<?php if (isset($CompteInexistant)) {echo '<div class="alert alert-danger" role="alert">'.$CompteInexistant.'</div>';}?>
					<?php if (isset($emailReqLogVide)) {echo '<div class="alert alert-danger" role="alert">'.$emailReqLogVide.'</div>';}?><br/>
			</div>
				
			<div class="form-group">
				<label for="password">Mot de Passe </label>
				<input type="password" name="password" class="form-control" value="<?php if (isset($passwordReqLog)) {echo $passwordReqLog;}?>"></input>
				
					<?php if (isset($passwordInvalide)) {?><?php echo '<div class="alert alert-danger" role="alert">'.$passwordInvalide.'</div>';}?>
					<?php if (isset($PasswordReqLogVide)) {echo '<div class="alert alert-danger" role="alert">'.$PasswordReqLogVide.'</div>';}?><br/>	
								
		    </div>
			
			<div class="text-center"><button type="submit" class="btn btn-success">Connexion</button></div>
		</form>

		<div class=""><p>Vous n'avez pas de compte ? <a class = "important" href="/accueil/inscription.html">Inscrivez vous !</a></p></div>	
	</div>
</div>