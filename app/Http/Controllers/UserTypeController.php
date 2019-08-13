<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    //



    public function user(Request $request){
        $this->ut='1' ;
        $request->session()->put('usertype',$this->ut);
        $project_id=0;
        $usertype='user';
        $page_title ='project list';
        $fff=$this->uts;
        return view('project.index', array('uts' => $fff));
    }
    public function ttadmin(Request $request){
        $this->ut='5' ;
        $request->session()->put('usertype',$this->ut);
        $page_title ='project list';
        parent::checkAuthorizebyUserID();
        $projects = \App\Models\Project::all();

        return view('project.index', array('uts' => $this->uts,'projects'=>$projects));

       

    }
    public function clientmanager(Request $request){
        $this->ut='2' ;
        $request->session()->put('usertype',$this->ut);
        $project_id=0;
        $usertype='ttadmin';
        $page_title ='project list';
        $fff=$this->uts;
        return view('project.index', array('uts' => $fff));
    }

}
