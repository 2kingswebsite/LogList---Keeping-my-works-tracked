<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //List The Project Done By the user
    public function index() 
    {
    	$user      = Auth()->user();
    	$projects  = $user->projects()->orderBy('id', 'desc')->get();
    	return view('profile.index',['user'     => $user, 
                                     'projects' => $projects]);
    }

    //Generate a token for collaboration
    public function token()
    {
    	$user  = Auth()->user();
    	$token = Hash::make($user);
    	$user->collab_token = $token;
    	$user->save();

    	return view('forms.token_generator_form', compact('token'));
    }

    //Regenerate an Other Token
    public function token2()
    {
        $user   = Auth()->user();
        $token  = Hash::make($user);
        $user->collab_token = $token;
        $user->save();

        return $token;
    }

    //get Form to add collab
    public function addCollab()
    {
        return view('forms.add_collaborator_form');
    }

    //get collaborator's details
    public function getDetailsCollab(Request $request)
    {
        $user = User::where('collab_token', $request->collab_token)->first();
        $project_id = $request->project_id;
        return view('forms.show_collab_details', compact('user','project_id'));
    }

    //request for a collaboration
    public function requestCollab($id, $project_id)
    {
        $user = User::findOrFail($id);
        $project = Project::findOrFail($project_id);

        //attach the new collab to the project
        $user_id = $user->id;
        $project->users()->attach($user_id);

        return 1;
    }


}
