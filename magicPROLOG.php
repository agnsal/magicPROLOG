<?php
/**
 *
 * @author Agnese Salutari: agneses92@hotmail.it
 */
class magicPROLOG{
    private $result="";
    
public function ADDtoResult($string){
    $string=$string."\r\n";
    $this->result=$this->result.$string;
}
    
public function getResult(){
    return $this->result;
}

public function delResult(){
    $this->result="";
}

public function notificationTXT($txt_name,$destination){
   $path=$destination."/".$txt_name.".txt";
    $handle=false;
    while($handle==false){
           $handle = fopen($path, 'w') or die('Cannot open file:  '.$my_file);
     } 
}

public function RESULTtoPL($my_file,$destination,$newFile){
    $path=$destination."/".$my_file.".pl";
    $handle=false;
    if($newFile===false){
        while($handle==false){
            $handle = fopen($path, 'a+') or die('Cannot open file:  '.$my_file);
        }
    }
    else {
        while($handle==false){
            $handle = fopen($path, 'w') or die('Cannot open file:  '.$my_file);
        }
    }
    fwrite($handle, "\r\n".$this->getResult());
} 

public function RESULTtoTXT($my_file,$destination,$newFile){
            $path=$destination."/".$my_file.".txt";
            $handle=false;
            if($newFile===false){
                while($handle==false){
                      $handle = fopen($path, 'a+'); 
                }
            }
            else {
                while($handle==false){
                      $handle = fopen($path, 'w') or die('Cannot open file:  '.$my_file);
                }
            }
            fwrite($handle, "\r\n".$this->getResult());
}

private function cleanName($str){
             $str= str_replace(' ', '_', $str);
             $str= str_replace('.', '', $str);
             $str= str_replace(',', '', $str);
             $str= str_replace('=', '', $str);
             $str= preg_replace("/[^a-zA-Z0-9_-]/", "", $str);
             $str=strtolower($str);
             if (preg_match('/^[a-z]+$/i',substr($str,0,1))==false){
                 $str=$s.substr($str,1);
             }
             return $str;
}

private function cleanJson($string){
             $string = str_replace("{", "", $string);
             $string = str_replace("}", "", $string);
             $string = str_replace('"', "", $string);
             $string = str_replace(' ', "", $string);
             $string=strtolower($string);
             return $string;
}

public function idConverter($numericId){
    $str= (string)$numericId;
    $str= str_replace('0', 'a', $str);
    $str= str_replace('1', 'b', $str);
    $str= str_replace('2', 'c', $str);
    $str= str_replace('3', 'd', $str);
    $str= str_replace('4', 'e', $str);
    $str= str_replace('5', 'f', $str);
    $str= str_replace('6', 'g', $str);
    $str= str_replace('7', 'h', $str);
    $str= str_replace('8', 'i', $str);
    $str= str_replace('9', 'l', $str);
    return $str;
}
    
public function JSONtoPmap($json,$mapName){ //Converte una stringa json in una stringa lista di Prolog
        if(!(is_string($json))) $json=(string)$json;
        $list=$this->cleanJson($json);
        $name=$this->cleanName($mapName);
        $risultato="";
        $arr = explode(',',trim($list));
        $l=count($arr);
        for($i=0; $i<$l; $i++){
            $map=explode(':',trim($arr[$i]));
            $r=$name."(".strtolower($map[0]).",".$map[1].").\r\n";
            $risultato=$risultato.$r;
        }
        $this->result=$this->result.$risultato;
        return $risultato;
}

private function cleanAssociativeArray($array){
        $array=json_encode($array);
        //echo($array); //test
        return $array;
}

public function ASSOCIATIVEARRAYtoPmap($array,$mapName){
    $mapName=$this->cleanName($mapName);
    $array=$this->cleanAssociativeArray($array);
    $array=$this->cleanJson($array);
    $risultato=$this->JSONtoPmap($array, $mapName);
    return $risultato;
}

public function ARRAYtoPpredicate($array,$predicateName){
    $predicateName=$this->cleanName($predicateName);
    $a="";
    $a=$a.$array[0];
    $l=count($array);
    for($i=1;$i<$l;$i++){
        $a=$a.",".$array[$i];
    }
    $risultato=$predicateName."(".$this->cleanJson($a).").\r\n";
    $this->result=$this->result.$risultato;
    return $risultato;
}


public function VALUEStoPlist($valuesArray,$listName){
    $v="";
    $v=$v.$valuesArray[0];
    $l=count($valuesArray);
    for($i=1;$i<$l;$i++){
        $v=$v.",".$valuesArray[$i];
    }
    $name=$this->cleanName($listName);
    $risultato=$name."=[".$v."].\r\n";
    $this->result=$this->result.$risultato;
    return $risultato;
}
    
    

}

?>
