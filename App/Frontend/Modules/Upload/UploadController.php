<?php
namespace App\Frontend\Modules\Upload;

use OCFram\BackController;
use OCFram\HTTPRequest;
use Entity\File;
use Entity\Directory;
use Entity\UserEntity;


class UploadController extends BackController
{
	public function executeFilesIndex (HTTPRequest $request)
	{	
		$this->page->addVar('title', 'Publec - Mes Fichiers');
				
		$user = $_SESSION['UserEntity'];
		
		if (($request->getExists('directory')) == FALSE) {
			$locationDir = $user->dirAuteur();
			$this->directorysList($user);
		}
		else {
			$locationDir = $user->dirAuteur().'/'.$request->getData('directory');
			$this->page->addVar('nameDirectory', $request->getData('directory'));
		}
		
		$this->filesList($locationDir);	
	}
	
	public function filesList($locationDir)
	{
		$filesManager = $this->managers->getManagerOf('Files');
		
		$listFiles = $filesManager->getList($locationDir);
		
		$this->page->addVar('listFiles', $listFiles);
	}
	
	public function directorysList(UserEntity $user)
	{
		$directorysManager = $this->managers->getManagerOf('Directorys');
		$listDirectorys = $directorysManager->getList($user);
		array_reverse($listDirectorys);
		array_shift($listDirectorys);
		$this->page->addVar('listDirectorys', $listDirectorys);
	}
	
	public function executeCreateDirectory(HTTPRequest $request)
	{
		$this->page->addVar('title', 'Publec - Creer un nouveau dossier');
		
		$user = $_SESSION['UserEntity'];
				
		$manager = $this->managers->getManagerOf('Directorys');
				
		$folder = $user->id().'_'.$user->nom();		
		
		if ($request->postExists('createDirectory')) {
			
			$reqNameDirectory = htmlspecialchars($request->postData('nameDirectory'));
			$this->page->addVar('nameDirectory', $reqNameDirectory);
			
			$directory = new Directory(array('name' => $reqNameDirectory,
											'auteur' => $user->nom(),
											'idAuteur' => (int)$user->id(),
											'dirAuteur' => $user->dirAuteur()));
			
			if ($this->CreateDirectoryFormIsValid($directory) == TRUE) {
				mkdir('../Users/'.$user->dirAuteur().'/'.$directory->name());	
				$manager->add($directory);
				$this->page->addVar('msgDossierCree', 'Votre dossier a bien été créé !');	
			}
		}
	}
	
	public function CreateDirectoryFormIsValid(Directory $directory)
	{
		$validation = TRUE;
		
		if (file_exists('../Users/'.$directory->dirAuteur().'/'.$directory->name())) {
			$this->page->addVar('msgDossier', 'Ce dossier existe déjà !');
			$validation = FALSE;
		}
		
		if (strlen($directory->name() > 50)) {
			$this->page->addVar('msgDossier', 'Le nom de dossier est trop long ! 50 caractères maximum !');
			$validation = FALSE;
		}
		
		if (!preg_match('#^[A-Za-z0-9_]+$#', $directory->name()))
		{
			$this->page->addVar('msgDossier', 'Vous avez utilisé des caractères interdits dans le nom de votre dossier. Vous ne pouvez utiliser uniquement des lettres, chiffres et l\'underscore (_).');
			$validation = FALSE;
		}
		
		return $validation;
	}
	
	
	public function executeUploadIndex(HTTPRequest $request)
	{
		set_time_limit(43200);
		
		$this->page->addVar('title', 'Publec - Upload');
		
		$user = $_SESSION['UserEntity'];
		//$this->page->addVar('dirAuteur', $user->dirAuteur());
		
		$filesManager = $this->managers->getManagerOf('Files');
		$directorysManager = $this->managers->getManagerOf('Directorys');		
				
		$listDirectorys = $directorysManager->getList($user);
		$listDirectorys[0]->setName('Dossier Principal');
		$this->page->addVar('listDirectorys', $listDirectorys);
		//$listDirectorys[-1];
	
		
		if ($request->postExists('upload')) {
			
			$directory = $directorysManager->getDirectory($request->postData('locationDir'));
			
			$reqUserUpload = array(
					'sujet' => htmlspecialchars($request->postData('sujet')),
					'descriptif' => htmlspecialchars($request->postData('descriptif')),
					'sizeFiles' => array_sum($request->filesData('fichier')['size']),
					'locationDir' => $request->postData('locationDir')
			);
				
			foreach ($reqUserUpload as $key => $value) {
				$this->page->addVar($key, $value);
			}
			
			//echo $reqUserUpload['locationDir'];
			
			$formIsValid = $this->uploadFormIsValid($reqUserUpload);
					
			if ($formIsValid == TRUE) {
				
				$fileUploadResult = array(
						0 => 'Le fichier a été uploadé avec succès.',
						1 => 'Ce fichier dépasse le poids maximal autorisé (2Go par upload max / php.ini).',
						2 => 'Ce fichier dépasse le poids maximal autorisé (2Go par upload max / MAX_FILE_SIZE).',
						3 => 'Le fichier n\'a été que partiellement uploadé. Réésayez ou contactez le webmaster.',
						4 => 'Aucun fichier uploadé. Réésayez ou contactez le webmaster.',
						6 => 'Erreur lors de l\'upload de votre fichier. Un dossier temporaire est manquant. Réésayez ou contactez le webmaster.',
						7 => 'Erreur lors de l\'écriture du fichier sur le disque. Réésayez ou contactez le webmaster.',
						8 => 'Erreur lors de l\'upload, une extension php a bloqué l\'upload du fichier. Réésayez ou contactez le webmaster.',
				);
				
				$countFiles = count($request->filesData('fichier')['name']);
				$directory->setNbFiles($directory->nbFiles() + $countFiles);
				
				$msgsResults = $countFiles. ' fichier(s) :<br>';
			
				foreach( $request->filesData('fichier')['error'] as $key => $error) {
					$msgsResults.= $request->filesData('fichier')['name'][$key].' => '. $fileUploadResult[$error].'<br/>';
					$this->page->addVar('msgsResults', $msgsResults);
				}
				
//var_dump($request->filesData('fichier'));
//var_dump($_POST);				
				for ($i = 0; $i < $countFiles; $i++) {
		
					//$folder = $reqUserUpload['locationDir']; //locationDir est unique car le nom du dossier principal est unique
					if ($user->dirAuteur() != $directory->name()) {
						$folder = $user->dirAuteur().'/'.$directory->name();
						//bon la y'a un pb : ce ****** de underscore doit �tre utilis� comme �a / pour faire les liens 
						//des fichiers mais comme �a \ pour la fonction move_upload_files...
						//alors en fait c'est pas sur ..........
					}
					else {
						$folder = $directory->name();
					}
			
					
					$nameFile = uniqid().'-'.$request->filesData('fichier')['name'][$i];					
					$fichier = new File(array(
							'auteur' => $user->nom(),
							'idAuteur' => $user->id(),
							'name' => $nameFile,
							'size' => $request->filesData('fichier')['size'][$i],
							'type' => $request->filesData('fichier')['type'][$i],
							'sujet' => $reqUserUpload['sujet'],
							'descriptif' => $reqUserUpload['descriptif'],
							'locationDir' => $folder,
							'idDirectory' => $directory->id()
					));
//var_dump($user);
//var_dump($fichier);
					if ($request->filesData('fichier')['error'][$i] == 0) 
					{
						move_uploaded_file($request->filesData('fichier')['tmp_name'][$i], '../Users/'.$folder.'/'.$nameFile);
						$filesManager->add($fichier);
						$directorysManager->updateDirectory($directory);
					}
				}		
			}
		}
	}
	
	public function uploadFormIsValid($reqUserUpload)
	{
		$validation = TRUE;
		
		if (strlen($reqUserUpload['sujet']) > 100) {
			$this->page->addVar('sujetOverLenght', '* Votre sujet est trop long. Il doit contenir 100 caractères au maximum.');
			$validation = FALSE;
		}
			
		if (strlen($reqUserUpload['descriptif']) > 400) {
			$this->page->addVar('textOverLenght', '* Votre descriptif est trop long. Il doit contenir 400 caractères au maximum.');
			$validation = FALSE;
		}
			
		$sizeFilesGo = $reqUserUpload['sizeFiles'] / 1000000000;
		
		if ($reqUserUpload['sizeFiles'] > 2000000000) {
			$this->page->addVar('filesOverSize', '* La totalité des fichiers à uploader ne doit pas dépasser 2Go. (Upload de :'.$sizeFilesGo.' Go)');
			$validation = FALSE;
		}
		
		if ($reqUserUpload['sizeFiles'] == 0) {
			$this->page->addVar('noFileSelected', '* Aucun fichier selectionné.');
			$validation = FALSE;
		}
				
		return $validation;
		
	}

	
	public function createForm($action, $sujet, $descriptifFichier, $error)
	{
		$form = '
		<form method="post" action="'.$action.'" enctype="multipart/form-data">
			
			<label>Sujet du/des fichier(s)(obligatoire) </label><input name="sujet" value="'.$sujet.'"></input>'. $error['sujet'].'<br>
			<label>Descriptif du/des fichier(s) (facultatif) </label><textarea name="descriptifFichier" rows="10" cols="60" value="'.$descriptifFichier.'"></textarea>
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000000"></input>	
			<input type="file" name="fichier[]" multiple="multiple"></input>'.$error['fichiers'].'<br/>
			
			<input type="hidden" name="upload"></input>
			<input type="submit" value="Envoyer le(s) fichier(s)"></input><br/>
		</form>';
		
		return $form;
	}
	
	public function executeDeleteDirectory(HTTPRequest $request)
	{
		if ($request->getExists('directoryToDelete')) 
		{
			$managerDirectorys = $this->managers->getManagerOf('Directorys');
			$managerFiles = $this->managers->getManagerOf('Files');
			$user = $_SESSION['UserEntity'];
			
			$id = $request->getData('directoryToDelete');
			$directory = $managerDirectorys->getDirectory($id);

			if ($directory != FALSE && $directory->idAuteur() == $user->id()) { // eviter que n'importe qui supprime les dossiers de n'importe qui
				
				$listFiles = $managerFiles->getList($directory->dirAuteur().'/'.$directory->name());								
				foreach ($listFiles as $file) 
				{
					unlink('../Users/'.$file->locationDir().'/'.$file->name());
					$managerFiles->deleteFile($file->id());
				}
			
				rmdir('../Users/'.$directory->dirAuteur().'/'.$directory->name().'/');
				$managerDirectorys->directoryDelete($id);
				
				$this->page->addVar('msgDossier', 'Le dossier '.$directory->name().' a bien été supprimé !');
			}
			else 
			{
				$this->app->httpResponse()->redirect('err.html');
			}
		}
	}
	
	public function executeDeleteFile(HTTPRequest $request)
	{
		if ($request->getExists('FileToDelete')) {
						
			$manager = $this->managers->getManagerOf('Files');
			$file = $manager->getFile($request->getData('FileToDelete'));			
			$user = $_SESSION['UserEntity'];
			
			if ($file != FALSE && $user->id() == $file->idAuteur()) {
				unlink('../Users/'.$file->locationDir().'/'.$file->name());
				//unlink('..\Users\\'.str_replace('/', '\\', $file->locationDir()).'\\'.$file->name());
				$manager->deleteFile($file->id());
				
				
				
				// modification du nombre de fichier dans le dossier
				$managerDirectory = $this->managers->getManagerOf('Directorys');
				$directory = $managerDirectory->getDirectory($file->idDirectory());
				$directory->setNbFiles($directory->nbFiles() - 1);
				$managerDirectory->updateDirectory($directory);
				
				
				// Code assurant la redirection après la supression du fichier
				$nbc = strrpos($request->getData('locationDir'), '/');
				$folder = substr($request->getData('locationDir'), $nbc);
				if ($folder == $user->dirAuteur()) {$folder = '';}
				$redirection = '/mesFichiers'.$folder.'.html';			
			
				$this->app->httpResponse()->redirect($redirection);
							
			}
			else {
				$this->app()->httpResponse()->redirect('err.html');
			}			
		}
	}
	
}