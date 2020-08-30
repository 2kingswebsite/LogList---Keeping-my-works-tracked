<?php
  


use App\Project;
use App\Task;


function getAmount($id)
{
		$project  = Project::find($id);
		$amount   = $project->total_amount;
	    return $amount;    
}
   
function getTasksCount($id)
{
		$project  = Project::find($id);
		$tasks    = $project->tasks()->count();
	    return $tasks;    
}
   
function getHours($id)
{
		$project  = Project::find($id);
		$hours    = $project->total_hours;
	    return $hours;    
}

function formatHours($time)
{
	$total_minutes = $time;

    $hours      = intval($total_minutes / 60);
    $minutes    = $total_minutes - ($hours * 60);

    if($hours == 0)
    {
      $total_hours_string = $minutes ." min";

    } else if($minutes == 0)
        {
            $total_hours_string = $hours . " h";

        } else
            {
                $total_hours_string = $hours . " h , " . $minutes ." min";
            }
    return $total_hours_string;
}
   



