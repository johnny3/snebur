<?php

namespace LFSM\ToolBundle\Entity;

class Tools {
    public static function stripAccents($str, $encoding='utf-8')
    {
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);

    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);

    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
    }
    
    public static function parse_csv_file($cleanData, $file, $columnheadings = false, $delimiter = ',', $enclosure = "\"")
    {
        $row = 1;
        $rows = array();
        $handle = fopen($file, 'r');

        while ((false !== $data = fgetcsv($handle, 1000, $delimiter, $enclosure))) 
        {
            if (!($columnheadings == false) && ($row == 1)) {
                $headingTexts = $data;
            } elseif (!($columnheadings == false)) {
                foreach ($data as $key => $value) {
                    unset($data[$key]);
                    if (in_array($headingTexts[$key], array_keys($cleanData))){
                       $data[$cleanData[$headingTexts[$key]]] = $value; 
                    }
                }
                $rows[] = $data;
            } else {
                $rows[] = $data;
            }
            $row++;
        }

        fclose($handle);
        return $rows;
    }
    
    
    public static function parse_csv_file_headers($file, $columnheadings = false, $delimiter = ',', $enclosure = "\"")
    {
        $row = 1;
        $headingTexts = array();
        $handle = fopen($file, 'r');

        while (($data = fgetcsv($handle, 1000, $delimiter, $enclosure)) !==
        FALSE) {

            if (!($columnheadings == false) && ($row == 1)) {
                $headingTexts[] = $data;
            }
            $row++;
        }

        fclose($handle);
        return current($headingTexts);
    }
    
    /**
     * Parse an array with dot
     *
     * @param tab
     * return tab with a space after the dot values
     */
    public static function replaceDotInTab($tab){
        $buffer = array();
        
        foreach ($tab as $key=>$val){
            $buffer[$key] = str_replace(',', ', ', $val);
        }
        
        return $buffer;
    }
}