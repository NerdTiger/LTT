<?php


namespace App\Helper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usertypeHelper
 *
 * @author kevin
 */
class UsertypeHelper {
    //put your code here
    public static function usertypes2Number($usertypes){
        if(empty($usertypes) || count($usertypes)==0) return 0;
        else{
        $bina='00000000'; 
        foreach($usertypes as $ut){
            $bina=substr_replace($bina,'1',$ut-1,1);
        }
        return bindec($bina);
        }
    }
    public static function number2Usertypes($number){
        $uts=[];
        if(empty($number) || $number==0) return null;
        else{
            $format = '%0' . (PHP_INT_SIZE * 1) . 'b';
            $bin = sprintf($format, $number);
            $ar_r=str_split($bin);
            foreach($ar_r as $key=>$value){
            if($value=='1'){
                array_push($uts,$key+1);
            }
            }
            return $uts;
        }
    }
}
