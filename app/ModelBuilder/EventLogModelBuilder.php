<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EventsLogModel{    
    public function logEventAddProject($projectID,$author){
        $log_action=LogAction::ADD;
        $log_subject=LogSubject::PROJECT;        
        $log_comments='project is added by '.$author.' with Project ID: '.$projectID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);  
        
    }
    
    public function logEventEditProject($projectID,$author){      
        $log_action=LogAction::EDIT;
        $log_subject=LogSubject::PROJECT;        
        $log_comments='project is editted by '.$author.' with Project ID: '.$projectID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }
    public function logEventDeleteProject($projectID,$author){        
        $log_action=LogAction::DELETE;
        $log_subject=LogSubject::PROJECT;        
        $log_comments='project is deleted by '.$author.' with Project ID: '.$projectID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }
    public function logEventAssignResource($projectID,$userID,$author){        
        $log_action=LogAction::ASSIGN;
        $log_subject=LogSubject::RESOURCE;        
        $log_comments='project with ID: '.$projectID.' is assigned by '.$author.' to : '.$userID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }
    public function logEventAssignPONumber($projectID,$PONumber,$author){      
        $log_action=LogAction::ASSIGN;
        $log_subject=LogSubject::PONUMBER;        
        $log_comments='project with ID: '.$projectID.' is bound by '.$author.' to PO with ID: '.$PONumber;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }

    public function logEventAddEntry($entryID,$author){   
        $log_action=LogAction::ADD;
        $log_subject=LogSubject::ENTRY;        
        $log_comments='entry is added by '.$author.' with entry ID: '.$entryID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }
    public function logEventEditEntry($entryID,$author){      
        $log_action=LogAction::EDIT;
        $log_subject=LogSubject::ENTRY;        
        $log_comments='entry is editted by '.$author.' with entry ID: '.$entryID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }
    public function logEventEditPo($poID,$author){      
        $log_action=LogAction::EDIT;
        $log_subject=LogSubject::PONUMBER;        
        $log_comments='purchase number is editted by '.$author.' with ID: '.$poID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }

    public function logEventDeleteEntry($entryID,$author){    
        $log_action=LogAction::DELETE;
        $log_subject=LogSubject::ENTRY;        
        $log_comments='entry is marked as deleted by '.$author.' with entry ID: '.$entryID;
        $this->insertEventsLog($log_action,$log_subject,$log_comments,$author);         
    }    
    
    

private function insertEventsLog($log_action,
$log_subject,
$log_comments,
$log_author){
    $insertstatement='INSERT INTO `eventslog`
(`log_action`,
`log_subject`,
`log_comments`,
`log_author`,
`log_date`)
VALUES
("'.$log_action.'","'.$log_subject.'","'.$log_comments.'","'.$log_author.'",CURRENT_TIMESTAMP)';
    ExecuteInsertStatement($this->db, $insertstatement);
    
}
public function querylogs($username,$fromdate,$todate){
    $querystatement = 'SELECT concat(u2.user_name,\' \',u2.user_lastname) entryuser,concat(u.user_name,\' \',u.user_lastname) changedBy,
el.log_action,el.log_section,el.log_subject,e.entry_hours,e.entry_date,el.log_date FROM eventslog el
inner join users u on el.log_author=u.user_id
inner join entries e on el.log_comments = e.entry_id
inner join jobs j on e.entry_job_id=j.job_id
inner join users u2 on e.entry_user=u2.user_id
where (u2.user_name like \'%'.$username.'%\' or u2.user_lastname like \'%'.$username.'%\')';
             if(isset($fromdate) && isset($todate))$querystatement.=' and e.entry_date between "'.$fromdate.'" and "'.$todate.'";';

    return ExecuteSQLQueryStatement($this->db, $querystatement);
}


}