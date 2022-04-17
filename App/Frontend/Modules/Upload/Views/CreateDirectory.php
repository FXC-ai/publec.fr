<div class="row">
	<div class="col-md-12">	
	<h4><a href="/mesFichiers.html"><span class="glyphicon glyphicon-arrow-left"></span>Retour à "Mes Fichiers"</a></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php ?>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Créer un nouveau dossier</h3>
				<p>*Le nom de votre dossier ne doit pas comporter d'espaces ni de caractères spéciaux.
				Vous pouvez utiliser des lettres, des nombres et l'uderscore (_).</p>
			</div>
			
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="" enctype="multipart/form-data" class="form-inline">
							<div class="form-group">
								<label for="createDirectory">Nom du nouveau dossier : </label>
								<input class = "form-control" name="nameDirectory" value="<?php if (isset($nameDirectory)) {echo $nameDirectory;}?>"></input>
								<input type="hidden" name="createDirectory"></input>
							
							</div>
							<button type="submit" class="btn btn-success">Créer</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if (isset($msgDossierCree)) {echo '<div class = "alert alert-success" role="alert">'.$msgDossierCree.'</div>';}?>	
						<?php if (isset($msgDossier)) {echo '<div class = "alert alert-danger" role="alert">'.$msgDossier.'</div>';}?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

