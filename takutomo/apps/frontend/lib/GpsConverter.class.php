<?php

class GpsConverter {

    function GpsConverter() {
    }
    
    public static function dmsToDegree($value){
      $a = explode(".", str_replace('+','',$value));
      return sprintf("%f", $a[0]+$a[1]/60+($a[2].".".$a[3])/3600);
    }
}
?>