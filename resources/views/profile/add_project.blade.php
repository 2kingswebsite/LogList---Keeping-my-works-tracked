@extends('layouts.index')


@section('extra-style')
<style>
    .btn-bottom {
        position: absolute;
        top: 0px;
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
                <div class="col-md-12">name</div>
                <div class="col-md-12">total Projects</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('project.create')}}" method="get">
                <div class="form-group row">
                    <label for="projectName" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="new Project" name="name" placeholder="new Project" >
                    </div>
                </div>
                <hr>
                <fieldset class="container">
                    <legend>Level</legend>
                    <div class="form-group row">
                        <label for="easy" class="col-sm-2 col-form-label">Very Easy</label>
                        <div class="col-sm">Min 
                            <input type="number" value="200" min="0" max="1000" step="5" name="very_easy_min" />$/h
                        </div>
                        <div class="col-sm">Max 
                            <input type="number" value="400" min="0" max="1000" step="5" name="very_easy_max" />$/h
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="easy" class="col-sm-2 col-form-label">Easy</label>
                        <div class="col-sm">Min 
                            <input type="number" value="200" min="0" max="1000" step="5" name="easy_min" />$/h
                        </div>
                        <div class="col-sm">Max
                            <input type="number" value="400" min="0" max="1000" step="5" name="easy_max" />$/h
                        </div>
                    </div>
                <hr>

                    <div class="form-group row">
                        <label for="medium" class="col-sm-2 col-form-label">Medium</label>
                        <div class="col-sm">Min 
                            <input type="number" value="200" min="0" max="1000" step="5" name="medium_min" />$/h
                        </div>
                        <div class="col-sm">Max 
                            <input type="number" value="400" min="0" max="1000" step="5" name="medium_max" />$/h
                        </div>
                    </div>
                <hr>
                    
                    <div class="form-group row">
                        <label for="hard" class="col-sm-2 col-form-label">Hard</label>
                        <div class="col-sm">Min 
                            <input type="number" value="200" min="0" max="1000" step="5" name="hard_min" />$/h
                        </div>
                        <div class="col-sm">Max 
                            <input type="number" value="400" min="0" max="1000" step="5" name="hard_max" />$/h
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hard" class="col-sm-2 col-form-label">Very Hard</label>
                        <div class="col-sm">Min 
                            <input type="number" value="200" min="0" max="1000" step="5" name="very_hard_min" />$/h
                        </div>
                        <div class="col-sm">Max 
                            <input type="number" value="400" min="0" max="1000" step="5" name="very_hard_max" />$/h
                        </div>
                    </div>


                </fieldset>
                <hr>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark btn-bottom">Confirm</button>
                </div>
            </form>  
        </div>
    </div>
</div>

@endsection
