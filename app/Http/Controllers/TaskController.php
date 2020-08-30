<?php

namespace App\Http\Controllers;

use App\Task; 
use App\Project;
use Carbon\Carbon;
use App\Http\Controllers\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //refresh the Project 
    private function refresh_project($id)
    {
        //find object
        $project = Project::find($id);
        //get sum of duration and amount
        $total_duration_minutes = $project->tasks()->sum('duration_minutes');
        $total_amount = $project->tasks()->sum('amount');

        //save results
        $project->total_hours   = $total_duration_minutes;
        $project->total_amount  = $total_amount;

        $project->save();
    }

    public function index()
    {
        //
    }

//show page for task creation
    public function create() 
    {
        $project_id = request()->input('project_id');
        return view('forms.add_task_form',['project_id' => $project_id]);
    }

//Store the new Task
    public function store(Request $request) 
    {
       $this->validate($request, [
            'level'         => ['required'],
            'timeStart'     => ['required'],
            'timeEnd'       => ['required'],
            'description'   => ['required','min:5'],
        ]);

        //get project id
        $project_id = $request->input('project_id');
        $date = $request->input('date');

        $task = new Task;
        //save some data
        $task->date             = $date ? $date : Carbon::now()->format('Y-m-d');
        $task->level            = $request->input('level');
        $task->author           = Auth()->user()->name;
        $task->author_id        = Auth()->user()->id;
        $task->description      = $request->input('description');
        $task->original_price   = $request->input('amount');


        //[side Calculation]
        //duration
        $start      = $request->input('timeStart');
        $end        = $request->input('timeEnd');
        //get hours and minutes in total
        $duration   = date_create($end)->diff(date_create($start));
        $hours      = $duration->format('%H');
        $minutes    = $duration->format('%i');
        $total      = $hours * 60 + $minutes;
        //rule for amount
        $total_amount = ($request->input('amount') * $total) / 60 ;


        //save amount in db
        $task->amount           = intval($total_amount);      
        $task->duration_minutes = $total;

        //format the duration saving
        if($hours == 0) 
        {
            $task->duration = $duration->format('%i min');
        } else if ($minutes == 0)
            {
                $task->duration = $duration->format('%H h');
            }
        else
        {
            $task->duration = $duration->format('%H h, %i min');
        }

        $task->time = date_create($start)->format("h:i A") 
                        . " -> " 
                        . date_create($end)->format("h:i A");


        //[relate task with project]
        $task->project_id = $project_id;

        $task->save();

//[got to work on it]//send some updated project's data to ajax
        //issue is , i can pass multiple var to ajax, but i cant include the view
        $this->refresh_project($project_id);    
        //get the refreshed project              
        $project    = Project::find($project_id);
        //get totals
        $duration   = $project->total_hours;
        $amounts    = $project->total_amount;
        $tasks      = $project->tasks()->count();

        return view('profile.tasks', compact('task'));

    }

    public function show($id)
    {
        //
    }

//show page to edit Task
    public function edit($id)
    {
        $task = Task::find($id);

        return view('forms.edit_task_form',['task' => $task]);

    }

//Update the Task
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'level'         => ['required'],
            'timeStart'     => ['required'],
            'timeEnd'       => ['required'],
            'description'   => ['required','min:5'],
        ]);

        $task = Task::findOrFail($id);

        $task->date         = $request->input('date');
        $task->author       = Auth()->user()->name;
        $task->author_id    = Auth()->user()->id;
        $task->level        = $request->input('level');
        $task->description  = $request->input('description');
        
        $task->original_price = $request->input('amount');

        //[Side calculations]
        //calculate duration
            $start      = $request->input('timeStart');
            $end        = $request->input('timeEnd');
        //get hours and minutes in total
            $duration   = date_create($end)->diff(date_create($start));
            $hours      = $duration->format('%H');
            $minutes    = $duration->format('%i');
            $total      = $hours * 60 + $minutes;
        //the rule for amount
            $total_amount = ($request->input('amount') * $total) / 60 ;

        //save in db
        $task->amount           = intval($total_amount);      
        $task->duration_minutes = $total;

        //format the duration saving
        if($hours == 0) 
        {
            $task->duration = $duration->format('%i min');
        } else if ($minutes == 0)
            {
                $task->duration = $duration->format('%H h');
            }
        else
        {
            $task->duration = $duration->format('%H h, %i min');
        }

        $task->time = date_create($start)->format("h:i A") 
                        . " -> " 
                        . date_create($end)->format("h:i A");

        $task->save();                
//[need to pass some varial to update the prices in page same issue with create task]
        return view("profile.tasks", compact('task'));
    }

//destroy Task   
    public function destroy($id)
    {
        //get Task
        $task = Task::findOrFail($id);
        //get its project id to search for it after the refresh
        $project_id = $task->project_id;
        //delete
        $task->delete();

        //[to refresh variable in the page]
        //refresh project
        $this->refresh_project($project_id);    
        //get the refreshed project              
        $project = Project::find($project_id);
        //get totals
        $duration       = $project->total_hours;
        $amounts        = $project->total_amount;
        $tasks          = $project->tasks()->count();

        $user_id        = Auth()->user()->id;
        $user_tasks     = $project->tasks()->where('author_id',$user_id);
        $duration_user  = $user_tasks->sum('duration_minutes');
        $amounts_user   = $user_tasks->sum('amount');
        $tasks_user     = $user_tasks->count();

        return [$task, $duration, $amounts, $tasks, $duration_user, $amounts_user, $tasks_user];
    }

}
