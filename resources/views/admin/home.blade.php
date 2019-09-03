@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard  <a href="create" class="btn btn-info text-light float-right"> Add Project </a></div>
                <div class="card-body">
                    @if(count($projects) > 0)
                    <ul class="list-group mb-3">
                         @foreach($projects as $project)
                            <li class="list-group-item mb-2">
                                <h4>{{$project->title}}</h4> <br/>
                                <a  href="{{$project->id}}" class="btn btn-secondary"> See Details </a>
                                <a  href="{{$project->id}}/edit" class="btn btn-info"> Edit Project </a>
                                <a href="{{$project->id}}/delete" class="btn btn-danger"> Delete </a> 
                            </li> 
                        @endforeach   
                    </ul>

                     {{$projects->links()}}
                     @else
                      <h3> No Projects in Repository </h3>
                     @endif 

                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
