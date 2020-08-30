@extends('layouts.index')


@section('extra-style')

<style>
    .btn-bottom {
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .progress {
        margin-top: 10em;
    }

</style>

@endsection


@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-2 px-0">
            <img src="https://via.placeholder.com/150" />
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">{{ $user->name}}</div>
                <div class="col-md-12">total Projects {{ $user->projects()->count()}}</div>
            </div>
        </div>
        <div class="col-md-2 mt-3 pl-5 pr-0">
            <a class="btn btn-dark btn-block" href="{{ route('project.collab')}}" 
                data-toggle="modal" data-target="#generate-token"
                id="generate-token-btn">
                Allow others to add Me
            </a>
            <a class="btn btn-dark btn-block" href="{{ route('project.add')}}" role="button">Add a new Project</a>
        </div>
    </div>
    
    <!-- the table -->
    <div class="row">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">total collaborator</th>
                    <th scope="col">created at</th>
                    <th scope="col">last update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <th scope="row">{{ $loop->index  }}</th>
                    <td><a href="{{ route('project.index' , $project->id)}}">{{$project->name}}</a></td>
                    <td>{{ $project->users()->count() }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!--Modals-->
@include('modals.collab_modal')

@endsection