<?php 

    $date_string_prepared   = date_create($task->date);
    $date_string            = $date_string_prepared->format("d M Y");


 ?>
 <style>
     .not-allowed
     {
        position: absolute;
        font-family: cursive;
        left: 0.6em;
        right: 2em;
        top: 1.5em;
        font-size: 22px;
        font-weight: 700;
     }
 </style>
<div class="row my-1 task-hover" id="task-{{$task->id}}">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-2 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="pl-2">{{ $date_string}}</span></span>
            </div>
            <div class="col-md-2 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="pl-2">{{ $task->author}} {{ $task->id}}</span></span>
            </div>
            <div class="col-md-2 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="pl-2">{{ $task->time}}</span></span>
            </div>           
            <div class="col-md-2 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="pl-2">{{ $task->duration}}</span></span>
            </div>    
            <div class="col-md-1 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="pl-2">{{ $task->level}}</span></span>
            </div>
            <div class="col-md-1 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="mx-auto">{{ $task->original_price}} $</span></span>
            </div> 
            <div class="col-md-2 mx-0 px-0">
                <span class="badge badge-dark d-flex py-2"><span class="mx-auto">{{ $task->amount}} $</span></span>
            </div>
        </div>
        <div class="row">
            @if(Auth()->user()->id == $task->author_id)
            <div class="col-md-3 row" style="max-height: 1em;">
                <button type="button" class="btn btn-warning btn-block col-sm-5 mr-3"
                        data-toggle="modal" data-target="#editTask"
                        id="edit-task-btn" href="{{ route('task.edit', $task->id) }}">Edit</button>

                <button type="button" class="btn btn-danger btn-block m-0 ml-2 col-sm-5"
                        data-toggle="modal" data-target="#destroyTask"
                        data-title="{{ $date_string }}" id="destroy-task-btn" 
                        href="{{ route('task.destroy', $task->id) }}">Delete</button>
            </div>
            @else
            <div class="col-md-3 row" style="max-height: 1em;">
                <button type="button" class="btn btn-warning btn-block col-sm-5 mr-3"
                        disabled>Edit</button>

                <button type="button" class="btn btn-danger btn-block m-0 ml-2 col-sm-5"
                        disabled>Delete</button>
            </div>
            <div class="not-allowed">Access Not Allowed</div>
            @endif


            <div class="col-md mx-0 px-0">
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" readonly> {{ $task->description}}</textarea>
                </div>
            </div>
        </div>

    </div>



</div>