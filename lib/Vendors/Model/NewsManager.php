<?php
namespace Model;

use \OCFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
  /**
   * M�thode retournant une liste de news demand�e
   * @param $debut int La premi�re news � s�lectionner
   * @param $limite int Le nombre de news � s�lectionner
   * @return array La liste des news. Chaque entr�e est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);
  
  /**
  * M�thode retournant une news pr�cise.
  * @param $id int L'identifiant de la news � r�cup�rer
  * @return News La news demand�e
  */
  abstract public function getUnique($id);
  
  abstract public function count();
  
  abstract protected function add(News $news);
  
  abstract protected function modify(News $news);
  
  abstract public function delete($id);

}