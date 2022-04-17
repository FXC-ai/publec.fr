
<div class="row">
	<div class = "col-md-3">
	<p><?php if (isset($listDirectorys)) {
	echo '<a href="/creerDossier.html"><button class="btn btn-success"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Créer un nouveau dossier</button></a>';
	}
	?></p></div>
	<div class = "col-md-offset-7 col-md-2">
	<p class="text-right"><?php echo '<a href="/upload.html"><button class="btn btn-success"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Ajouter un fichier</button></a>'; ?></p>
	</div>
	
</div>

<div class="row">


		<?php 
	
	  	if (isset($listDirectorys)) { ?>
	<div class = "col-md-12">
	<div class = "panel panel-info">
	<div class="panel-heading"><h4>Sous-Dossier(s)</h4></div>	  	
	  	
	  	<?php  	
	  	
	  	echo '<table class="table">';
	  	//echo '<tr><th>Dossier(s)</th><th>Nombre de fichiers</th><th>Supprimer</th></tr>';
		  	foreach ($listDirectorys as $directory) {
		  		echo '<tr>';
		  		echo '<td><img src="/Web/images/folderImg.png" alt="Dossier" />
					  <a href="/mesFichiers/'.$directory->name().'.html">'.$directory->name().'</a></td>'.
		  		'<td><a href="/mesFichiers-deleteDirectory-'.$directory->id().'.html"><img src="/Web/images/delete.png" alt="Supprimer" class="img-responsive center-block"/></a></td>';
		  		echo '</tr>';
		  	}
		echo '</table>';
		
		echo '<br/>';
  	?></div>
  	</div>	<?php 	
	  	}
	  	else
	  	{?>
	  		<div class="col-md-12"><h4><a href="/mesFichiers.html"><span class="glyphicon glyphicon-arrow-left"></span>Retour Dossier principal</a></h4></div>
	  	<?php }
	  	?>

</div>

<div class="row">
	<div class = "col-md-12">
	<div class="panel panel-info">
	<div class="panel-heading"><h4><?php if (isset($nameDirectory)) {echo $nameDirectory;} else {echo 'Dossier principal';}?></h4></div>
<table class="table">

  	<!--  '<tr><td>'.$filesCount.' Fichier(s) : </td></tr>'; -->
  	<tr><th></th><th>Sujet</th><!-- <th>Descriptif</th> --><th>Date d'ajout</th><th></th></tr>
  	<?php 
	foreach ($listFiles as $file) {
		echo '<tr>';
		echo '<td><img src="/Web/images/fichier.gif" alt="Dossier" />
					<a href="/Users/'.$file->locationDir().'/'.$file->name().'">'.substr($file->name(), 14).'</a></td>'.
			'<td>'.substr($file->sujet(), 0, 50).'</td>'.
			//'<td>'.substr($file->descriptif(),0,100).'</td>'.
			'<td>'.$file->dateAjout()->format('Y-m-d H:i:s').'</td>'.
			'<td>'.'<button type="submit" class="btn btn-info">Copier le lien</button>'.'<td>'.
			'<td><a href="/mesFichiers-deleteFile-'.$file->locationDir().'-'.$file->id().'.html"><img src="/Web/images/delete.png" alt="Supprimer" /></a></td>';
		echo '</tr>';
	}
	?>
</table>
	</div>
</div>
</div>