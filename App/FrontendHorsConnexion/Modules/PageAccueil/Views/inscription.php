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

		<h2>Inscription</h2>
		<form method="post" action="">
			<input type="hidden" name="formInscription" ></input>
			
			<div class="form-group">
			<?php ?>
			<label for="nom">Nom</label>
		    <input type="text" class="form-control" name="nom" id="nom" value="<?php if (isset($nomReqIns)) {echo $nomReqIns;} ?>"></input>
		    <?php 
		    if (isset($nomVide)) {echo '<div class="alert alert-danger" role="alert">'.$nomVide.'</div>';}
		    if (isset($nomLong)) {echo '<div class="alert alert-danger" role="alert">'.$nomLong.'</div>';}    
		    ?>
		    </div>
		
			<div class="form-group">
			<?php ?>
		    <label>Prénom</label>
		    <input type="text" name="prenom" class="form-control" value="<?php if (isset($prenomReqIns)) {echo $prenomReqIns;} ?>"></input>
		    <?php 
		    if (isset($prenomVide)) {echo '<div class="alert alert-danger" role="alert">'.$prenomVide.'</div>';}
		    if (isset($prenomLong)) {echo '<div class="alert alert-danger" role="alert">'.$prenomLong.'</div>';}    
		    ?>
		    </div>
		    
			<div class="form-group">
		    <label>E-mail</label>
		    <input type="email" name="email" class="form-control"  value="<?php if (isset($emailReqIns)) {echo $emailReqIns;} ?>"></input>
		    <?php 
		    if (isset($emailVide)) {echo '<div class="alert alert-danger" role="alert">'.$emailVide.'</div>';}
		    if (isset($UserConnu)) {echo '<div class="alert alert-danger" role="alert">'.$UserConnu.'</div>';}
		    ?>
		    </div>
			
			<div class="form-group">
			<label>Mot de passe</label>
			<input type="password" name="password" class="form-control" value="<?php if (isset($passwordReqIns)) {echo $passwordReqIns;}?>"></input>
			<?php 
		    if (isset($passwordCourt)) {echo '<div class="alert alert-danger" role="alert">'.$passwordCourt.'</div>';}
		    if (isset($passwordVide)) {echo '<div class="alert alert-danger" role="alert">'.$passwordVide.'</div>';}
		    ?>	
			</div>
			
			<div class="checkbox">
    		<label>
				<input type="checkbox" name="checkCGU" value="1"> J'ai lu et j'accepte les <a href="/Web/infos/CGU.pdf">conditions générales d'utilisations.</a>
			</label>
			<?php 
		    if (isset($checkCGUFALSE)) {echo '<div class="alert alert-danger" role="alert">'.$checkCGUFALSE.'</div>';}
		    ?>			
  			</div>
	
					
			<div class="text-center"><button type="submit" class="btn btn-success">Inscription</button></div>
		</form>
		
		<p>Vous avez un compte ? <a class = "important" href="/accueil/index.html">Connectez-vous !</a></p>
			</div>
</div>

<!-- 
<div class="row">
	<div class="col-md-12"><p style="font-size: 180px; color: rgba(120,202,200,0)">Publec</p></div>
</div>
-->