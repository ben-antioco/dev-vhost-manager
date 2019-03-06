<?php

namespace App;

class CommonFunction
{
    /**
    * Supprimer les accents
    * 
    * @param string $str chaîne de caractères avec caractères accentués
    * @param string $encoding encodage du texte (exemple : utf-8, ISO-8859-1 ...)
    */
    public function supprAccents($str, $encoding='utf-8')
    {
        // transformer les caractères accentués en entités HTML
        $str = htmlentities($str, ENT_NOQUOTES, $encoding);
    
        // remplacer les entités HTML pour avoir juste le premier caractères non accentués
        // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
        $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    
        // Remplacer les ligatures tel que : , Æ ...
        // Exemple "œ" => "oe"
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        // Supprimer tout le reste
        $str = preg_replace('#&[^;]+;#', '', $str);

        $str = preg_replace("'", '-', $str);
    
        return $str;
    }

    /**
     * FILTER DATA
     */
    public function formFilterData( $data ) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}