@extends('layouts.index')


@section('extra-style')
<style>
    .btn-bottom {
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .center {
        text-align: center !important;
    }
    .progress {
        margin-top: 10em;
    }        
    
</style>
@endsection



@section('content')
<?php 

    // $description_decoded = json_decode($project->description)[0];
    // $date_content = json_decode($description_decoded);         //-> date, content
    //     $date = $date_content->date;
    //     $content = $date_content->content;

    // $content_decoded = json_decode($content);                //->author, when, level, amount, description
    //     $author = $content_decoded->author;
    //     $when = $content_decoded->when;
    //     $level = $content_decoded->level;
    //     $amount = $content_decoded->amount;
    //     $description = $content_decoded->description;
    
    // $total_minutes = $project->total_hours;

    // $hours = intval($total_minutes / 60);
    // $minutes = $total_minutes - ($hours * 60);

    // if($hours == 0)
    // {
    //   $total_hours_string = $minutes ." min";

    // } else if($minutes == 0)
    //     {
    //         $total_hours_string = $hours . " h";

    //     } else
    //         {
    //             $total_hours_string = $hours . " h , " . $minutes ." min";
    //         }

    //user Part
    $the_user = $project->tasks()->where('author_id', Auth()->user()->id);         
    $total_amount_user  = $the_user->sum('amount');
    $total_hours_user   = $the_user->sum('duration_minutes');



 ?>
<div class="container">

    <div class="row">
        <div class="col-md-2 px-0">
            <img src="https://via.placeholder.com/150" />
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12 mt-1">name : {{ Auth()->user()->name }}</div>
                <div class="col-md-12 mt-1">total Projects : {{ Auth()->user()->projects()->count() }}</div>
            </div>
            <div class="row">
                <div class="col-md-12 horizontal-word-line">&nbsp; Me in this project &nbsp;</div>
                <div class="col-md-12 ">
                    <span>tasks done by me: </span>
                    <span id="total-tasks-user">{{ $project->tasks()->where('author_id', Auth()->user()->id)->count() }}</span>
                </div>
                <div class="col-md-12 ">
                    <span>Total part raised: </span>
                    <span id="total-amount-user">{{ $total_amount_user }} $</span>
                </div>
                <div class="col-md-12 ">
                    <span>Total hours spent: </span>
                    <span id="total-hours-user">{{ formatHours($total_hours_user) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="col-md-12">
                <div class="row">
                    <label class="col-sm-5 my-0 mt-1">Project name : </label>
                    <label class="col-sm-7 my-0 mt-1"> {{ $project->name }} </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <label class="col-sm-5 my-0"><a href="">Total collaborator : </a></label>
                    <label class="col-sm-7 my-0"> {{ $project->users()->count() }} </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <label class="col-sm-5 my-0">Total Tasks :</label>
                    <label class="col-sm-7 my-0" id="total-tasks"> {{ $project->tasks()->count() }} </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <label class="col-sm-5 my-0"><a href="">Total hours : </a></label>
                    <label class="col-sm-7 my-0" id="total-hours"> {{ formatHours($project->total_hours) }} </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <label class="col-sm-5 my-0">Amount : </label>
                    <label class="col-sm-7 my-0" id="total-amount"> {{ getAmount($project->id) }} $</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <label class="col-sm-5 my-0">Description : </label>
                    <label class="col-sm-7 my-0"> {{ $project->description }} </label>
                </div>
            </div>
        </div>
        <div class="col-md-2 row px-0 mx-0">
            <div class="col-md-12 px-0">
                <a  class="btn btn-dark btn-bottom btn-block" 
                    href="{{ route('project.add.Collab') }}" role="button"
                    data-title="{{ $project->id }}"
                    data-toggle="modal" data-target="#addCollaborator" id="add-collaborator">
                    Add a contributor
                </a>
            </div>
            <div class="col-md-12">
                <a  class="btn btn-dark btn-bottom btn-block " 
                    data-title="{{ $project->id }}" 
                    href="{{ route('task.create') }}" 
                    role="button" 
                    data-toggle="modal" 
                    data-target="#addTask"
                    id="add-task-btn">
                Add a task
                </a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('modals.add_task_modal')
    @include('modals.edit_task_modal')
    @include('modals.destroy_task_modal')
    @include('modals.add_collaborator_modal')

    <div class="row mt-4">
        <div class="col-md-12 px-0">
            <div class="alert alert-success mb-1 text-center" id="update-alert" style="display: none;">
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto">date</span></span>
                </div>
                <div class="col-md-2 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto">author</span></span>
                </div>
                <div class="col-md-2 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto">when</span></span>
                </div>           
                <div class="col-md-2 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto">hours</span></span>
                </div>    
                <div class="col-md-1 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto">level</span></span>
                </div>
                <div class="col-md-1 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto"> $/h </span></span>
                </div>
                <div class="col-md-2 mx-0 px-0">
                    <span class="badge badge-dark d-flex py-2"><span class="mx-auto">Total amount</span></span>
                </div>
            </div>
        </div>
        <div class="col-md-1 px-0">

        </div>
    </div>
    <div id="task-list">
    @foreach($tasks as $task)
        @include('profile.tasks', $task)
    @endforeach
    </div>
</div>

@endsection

