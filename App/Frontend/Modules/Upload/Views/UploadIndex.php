

<div class="row">
	<div class = "col-md-6">
		<div class="panel panel-default">
		
			<div class="panel-heading">
			<h3> Uploader des fichiers</h3>
			<p>La taille maximum de tout les fichiers envoyés ne doit pas dépasser 2 Go.</p>
			</div>
		
			<div class="panel-body">
				<form class="" method="post" action="" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="sujet" >Sujet du/des fichier(s) </label>
						<input class = "form-control" name="sujet" value="<?php if (isset($sujet)) {echo $sujet;}?>"></input>
						<?php 
						if (isset($sujetVide)) {echo '<div class="alert alert-danger" role="alert">'.$sujetVide.'</div>';}
						if (isset($sujetOverLenght)) {echo '<div class="alert alert-danger" role="alert">'.$sujetOverLenght.'</div>';}
						?>
					</div>
					
					<div class="form-group">
						<label for="descriptif">Descriptif du/des fichier(s) </label>
						<textarea class = "form-control" name="descriptif" rows="4" cols="60" ><?php if (isset($descriptif)) {echo $descriptif;} ?></textarea>
						<?php if (isset($textOverLenght)) {echo '<div class="alert alert-danger" role="alert">'.$textOverLenght.'</div>';}?>
					</div>
					
					<div class="form-group">
						<label>Choix du Dossier : </label>
						<select class = "form-control" name="locationDir">
							<!-- <option value="<?php //echo $dirAuteur?>">défaut</option> -->
							<?php foreach ($listDirectorys as $directory) {
								echo '<option value="'.$directory->id()/*$dirAuteur.'/'.$directory->name()*/.'" >'.$directory->name().'</option>';
							}?>
						</select>
					</div>	
					
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000000"></input>
					
					<div class="form-group">
						<input class = "form-control" type="file" name="fichier[]" multiple="multiple"></input>
						<?php 
						if (isset($noFileSelected)) {echo '<div class="alert alert-danger" role="alert">'.$noFileSelected.'</div>';}
						if (isset($filesOverSize)) {echo '<div class="alert alert-danger" role="alert">'.$filesOverSize.'</div>';}
						?>
					</div>
					
					<input type="hidden" name="upload"></input>
					
					<button type="submit" class="btn btn-success">Envoyer</button>
					
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
			<?php if (isset($msgsResults)) {echo '<h4 class="alert alert-info" role="alert">'.$msgsResults.'</h4>';}?>
	</div>
</div>