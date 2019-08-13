<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Helper\UserAuthorizeHelper;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $uts;
    protected $ut;
    protected $lockoff;

    
    public function __construct(){

    }
    
    public function checkAuthorizebyUserID(){
        try{
            
            $this->uts = UserAuthorizeHelper::getUserAuthorizebyUserID(430);
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";

        }
    
    }
    public function getLockOff(){
        try{
            
            $this->lockoff = \App\Models\Option::where('option_name','=','lock_date')->get();
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";

        }
    }
}
