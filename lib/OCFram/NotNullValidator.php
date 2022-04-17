<?php
namespace OCFram;

class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != ''; // opérateur de comparaison qui renvoie false si value est vide et true si value contient une chaîne de caractère
  }
}