<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    //Refresh Project
    private function refresh_project($id)
    {
        
        $project = Project::find($id);              //find project
        $total_duration_minutes = $project->tasks()->sum('duration_minutes'); //get sum of duration and amount
        $total_amount = $project->tasks()->sum('amount');

        //save results
        $project->total_hours   = $total_duration_minutes;
        $project->total_amount  = $total_amount;

        $project->save();
    }

//show Project's tasks
    public function index($id) 
    {   
        //refresh selected Project 
        $this->refresh_project($id);                  

        //find the project from db
        $project    = new Project;
        $tasks      = new Task;
        $project    = Project::where('id', $id)->first();

        //if it doesnt exist
        if(!$project)
        {
            abort(404, 'doesn\'t exist.');
        }
        //verify if the user exists in relation ship
        $hasProject = $project->users()->where('user_id', Auth()->user()->id)->exists();

        if(!$hasProject)
        {
            abort(404, 'doesn\'t exist.');
        }

        //Everything is cool
        $tasks = Task::where('project_id', $id)->orderBy('id', 'desc')->get();
    	return view('profile.show_project', ['project' => $project, 'tasks' => $tasks]);
    }

//Page to add project
    public function add() 
    {
        //return the page
    	return view('profile.add_project');
    }

    public function edit($id) 
    {

    }

//Create New Project
    public function create() 
    {
        //new project object
        $project = new Project;
        //get values from request()->input('')
        $project->name = request()->input('name') ;
        //encode level values as a JSON object
        $level_JSON = json_encode([
		    'Very Easy'   => [request()->input('very_easy_min'),request()->input('very_easy_max') ],
		    'Easy'        => [request()->input('easy_min'),request()->input('easy_max') ],
            'Medium'      => [request()->input('medium_min'),request()->input('medium_max') ],
            'Hard'        => [request()->input('hard_min'),request()->input('hard_max') ],
		    'Very Hard'   => [request()->input('very_hard_min'),request()->input('very_hard_max') ],
                ]);
        $project->level_details = $level_JSON ;
        //fill the description
        $project->description   = request()->input('description') ;
        //save the new project object in db
        $project->save();

        //save the relation many to many btween user and project
        $user_id = Auth()->user()->id;
		$project->users()->attach($user_id);
        // redirect to page
        //[[[with success]]] --> (NOYET)
    	return view('profile.show_project',['project' => $project, 'tasks' => $project->tasks()]);
    }


}

/*

        $desctiption_details_details = json_encode([
                    'author' => Auth()->user()->name,
                    'when' => Carbon::now()->format('H:i'),
                    'level' => 'NEW',
                    'amount' => '0',
                    'description' => '- The project has just been created',
                ]);
        $desctiption_details = json_encode([
                    'date' => Carbon::now()->format('Y-m-d'),
                    'content' => $desctiption_details_details,
                ]);
        $description_JSON = json_encode([
                    '0' => $desctiption_details,
                ]);
        $project->description = $description_JSON ;










*/
