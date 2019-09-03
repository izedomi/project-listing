@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <h3> Project Detail </h3>

           <hr>
           <h3 class="text-info"> Title </h3>
           <p class="lead"> {{$project->title}} </p>
          

           <hr>
           <h3 class="text-info"> Description </h3>
            <div> <p class="lead"> {{$project->description}}</p> </div>
           <hr>

          
           <h3 class="text-info"> File Name </h3>
           <p class="lead"> <a href="/storage/project_files/{{$project->file_path}}" download="true" class="text-dark">{{$project->file_path}}</a></p>
           <hr>
           <a href="/" class="btn btn-info"> Go Back </a>
           <a href="/storage/project_files/{{$project->file_path}}" download="true" class="text-light btn btn-danger">download project</a>
          
        </div>
    </div>
</div>
@endsection
