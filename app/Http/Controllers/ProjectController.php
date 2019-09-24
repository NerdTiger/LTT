<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostCollection;


use App\ModelBuilder\ProjectModelBuilder;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $project_model_Builder;

    public function __construct(){
        // parent::checkAuthorizebyUserID();
        // parent::getLockOff();
        $this->project_model_builder = new ProjectModelBuilder();
    }
    public function listproject(){

        $projects=$this->project_model_builder->getProjectList();
        if(empty($projects)){
            //   $message='user is not authorized';
            //   $partpagepath='views/login/showmessage.php';
            //   require_once('views/login/login.php');
        }                  
        else return $projects;

    }
           
    
/*
$post = new Post([
        'title' => $request->get('title'),
        'body' => $request->get('body')
      ]);

      $post->save();

      return response()->json('success');
       */
    public function index(Request $request)
    {
        /*
        $this->ut='5' ;
        $request->session()->put('usertype',$this->ut);

        $usertype='ttadmin';
        $page_title ='project list';

        //$projects = \App\Models\Project::all();
        $projects=DB::table('project')
        ->leftjoin('project_resource','project.project_id','project_resource.project_resource_project_id')
        ->leftjoin('time_entry','time_entry.entry_project_resource_id','project_resource.project_resource_id')
        ->join('project_status','project_status.project_status_id','project.project_status')
        ->groupBy('project_id', 'project_start', 'project_number', 'project_title', 'project_renewal', 'project_type', 'project_payee',  'project.project_status', 
        'project_end')        
        ->selectRaw('project_id, project_start, project_number, project_title, project_renewal, project_type, project_payee,  project.project_status, 
        project_end,
        sum(project_resource_hours)as allocatedhours, sum(entry_hours) as loggedhours') 
        ->get(); 
        //echo $projects[0]->project_number;
        return view('project.index', array('uts' => $this->uts,'projects'=>$projects,'lockoff'=>$this->lockoff));
        */


            
        


        
     }
     public function searchproject(Request $request) 
     {
         
        $var = $request->input('projectnumber'); 
        
        $projectnumber = (isset($var) && $var!='')?$var:'';
        
        
        $var = $request->input('projectrenewal'); 
        $projectrenewal = (isset($var) && $var!='')?$var:'';
        $var = $request->input('projecttitle'); 
        $projecttitle = (isset($var) && $var!='')?$var:'';
        $var = $request->input('projectuser'); 
        $projectuser = (isset($var) && $var!='')?$var:'';
        $var = $request->input('projectpo'); 
        $projectpo = (isset($var) && $var!='')?$var:'';
        $var = $request->input('projectstartfrom'); 
        $projectstartfrom = (isset($var) && $var!='')?$var:'';
        $var = $request->input('projectstartto'); 
        $projectstartto = (isset($var) && $var!='')?$var:'';
        
        $projects=DB::table('project')
        ->leftjoin('project_resource','project.project_id','project_resource.project_resource_project_id')
        ->leftjoin('time_entry','time_entry.entry_project_resource_id','project_resource.project_resource_id')
        ->join('project_status','project_status.project_status_id','project.project_status')
        ->where('project_number',$projectnumber) 
        ->groupBy('project_id', 'project_start', 'project_number', 'project_title', 'project_renewal', 'project_type', 'project_payee',  'project.project_status', 
        'project_end')        
        ->selectRaw('project_id, project_start, project_number, project_title, project_renewal, project_type, project_payee,  project.project_status, 
        project_end,
        sum(project_resource_hours)as allocatedhours, sum(entry_hours) as loggedhours') 
        ->get(); 
        if(count($projects)===0){
            echo 'NO ROWS found.';
            return;
        }
        
        return view('project.index', array('uts' => $this->uts,'projects'=>$projects,'lockoff'=>$this->lockoff));
        
        
        
        
    }
     public function saveNewProject(){


        DB::table('project')->insert(
            [
                `project_year`=> $project_year, 
                `project_submitter`=> $project_submitter, 
                `project_created_date`=> $project_created_date, 
                `project_priority`=> $project_priority, 
                `project_renewal`=> $project_renewal, 
                `project_number`=> $$project_number, 
                `project_title`=> $project_title, 
                `project_location`=> $project_location, 
                `project_functional_area_id`=> $project_functional_area_id, 
                `project_division`=> $project_division, 
                `project_budget`=> $project_budget, 
                `project_commission`=> $project_commission, 
                `project_bonus`=> $project_bonus, 
                `project_cisco_rate_card`=> $project_cisco_rate_card, 
                `project_company`=> $project_company, 
                `project_salesbeacon_company`=> $project_salesbeacon_company, 
                `project_sponsor`=> $project_sponsor, 
                `project_sponsor_title`=> $project_sponsor_title, 
                `project_start`=> $project_start, 
                `project_end`=> $project_end, 
                `project_original_hours`=> $project_original_hours, 
                `project_practice_area_id`=> $project_practice_area_id, 
                `project_currency`=> $project_currency, 
                `project_payee`=> $project_payee, 
                `project_status`=> $project_status, 
                `project_notes`=> $project_notes, 
                `project_type`=> $project_type

            ]
        );
     }
     public function index2(Request $request)
     {
 /*
        $projects = \App\Models\Project::groupBy('project_number')//where('project_id','>', 100)
        ->selectRaw('sum(project_renewal) as sum_renewal, project_number')
        ->pluck('sum_renewal','project_number');
        echo $projects;
        sum success
        */
/*        $projects=DB::table('project')
        ->leftjoin('project_resource','project.project_id','project_resource.project_resource_project_id')
        ->leftjoin('time_entry','time_entry.entry_project_resource_id','project_resource.project_resource_id')
        ->join('project_status','project_status.project_status_id','project.project_status')
        ->groupBy('project_id', 'project_start', 'project_number', 'project_title', 'project_renewal', 'project_type', 'project_payee',  'project.project_status', 
        'project_end')        
        ->selectRaw('project_id, project_start, project_number, project_title, project_renewal, project_type, project_payee,  project.project_status, 
        project_end,
        sum(project_resource_hours)as allocatedhours, sum(entry_hours) as loggedhours') 
        ->get(); 
        echo $projects;

*/
echo $this->lockoff;
        //->orderBy('project_number', 'desc')
        //->take(10)
        //->get();
        //echo count($this->uts);

        //$sub = \App\Models\Project::where('')->groupBy(''); // Eloquent Builder instance
        /*$stubs = \App\Models\Project::where('project_id','>', 100)
               ->orderBy('project_number', 'desc')
               ->take(10)
               ->get();
               */
/*
        $count = DB::table( DB::raw("({$sub->toSql()}) as sub") )
            ->mergeBindings($sub->getQuery()) // you need to get underlying Query Builder
            ->count();
            */
      }
 

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
