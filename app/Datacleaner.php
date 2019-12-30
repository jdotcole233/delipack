<?php

namespace App;

class Datacleaner{

   public static function cleaner ($requests){
        $request_gen = [];
        foreach($requests as $key => $value){
               if ($key == "registered_number") {
                 $charas = str_split(trim($value));
                 $charas[0] =  ucfirst($charas[0]);
                 $charas[1] =  ucfirst($charas[1]);
                 $request_gen[$key] = implode("" ,$charas);
               } else if ($key != "about" && $key != "password" && $key != "email" && $key != "email_more" && $key != "region"){
                 $request_gen[$key] = ucfirst(strtolower(trim($value)));
               } else {
                 $request_gen[$key] = $value;
               }
        }
        return $request_gen;
   }

}
