<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\ModelBuilder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingModelBuilder {

    function getSiteInfo(){
        $rows=DB::table('system_messages')->where('message_type',1)->get();
        if(isset($rows)&& count($rows)>0)return $rows[0][2];
        else return '';
    }
    public function getLockdate(){
        $query = \App\Models\Option::where('option_name','lock_date')->select('option_name','option_value');
        $rows = $query->first();
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
        // dd($sql);
        // dd($rows);
        return $rows;
        //dd($result);
        // if($result->isEmpty()){return '';}
        // else{    return $result[0][1];}
    }
}
