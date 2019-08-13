<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $this->ut='5' ;
        $request->session()->put('usertype',$this->ut);

        $usertype='ttadmin';
        $page_title ='entry list';

        parent::checkAuthorizebyUserID();
        $entries = \App\Models\TimeEntry::all();
        //echo count($this->uts);

        return view('entry.index', array('uts' => $this->uts,'entries'=>$entries));
     }
}
