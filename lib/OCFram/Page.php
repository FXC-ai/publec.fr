<?php
Namespace OCFram;

class Page extends ApplicationComponent
{
  protected $contentFile;
  protected $vars = array() /*[]*/;

  public function addVar($var, $value)
  {
    if (!is_string($var) || is_numeric($var) || empty($var))
    {
      throw new \InvalidArgumentException('Le nom de la variable doit �tre une chaine de caract�res non nulle');
    }

    $this->vars[$var] = $value;
  }

  public function getGeneratedPage()
  {	
  	
  	
    if (!file_exists($this->contentFile))
    {
      	
		throw new \RuntimeException('La vue sp�cifi�e n\'existe pas');
      //echo 'oioijoijoijoiieoqijzfozijfoarzigjozeirqjg';
    }

    $user = $this->app->user();
       
    extract($this->vars); //Ces variables sont exploitables dans la view comme on veut c'est monstre pratique
    
	ob_start();
      require $this->contentFile;
      
    $content = ob_get_clean();
    
    ob_start();
      require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
    return ob_get_clean();    
  }

  public function setContentFile($contentFile) //Cette méthode est appelée dans la méthode setAction du BackControlller !!
  {
    if (!is_string($contentFile) || empty($contentFile))
    {
      throw new \InvalidArgumentException('La vue spécifiée est invalide');
    }

    $this->contentFile = $contentFile;
  }
  
  public function getContentFile()
  {
  	return $this->contentFile;
  }
}
