@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {!!Form::open(['method' => 'post', 'action' => 'PublicController@search'])!!}
                {{Form::text('search', '', ['class' => 'form form-control mb-2', 'placeholder' => 'Enter Keyword'])}}
                {{Form::submit('search', ['class' => 'btn btn-info mb-2'])}}
            {!!Form::close()!!}
           
            <div class="card">
                <div class="card-header">Resource Bank <i class="fa fa-check"></i></div>
                <div class="card-body">
                    @include('inc.messages')
                    @if(count($projects) > 0)
                    <ul class="list-group mb-3">
                         @foreach($projects as $project)
                            <li class="list-group-item mb-2">
                                <h4>{{$project->title}}</h4> <br/>
                                <a  href="project_info/{{$project->id}}" class="btn btn-secondary"> See Details </a>
                                <a  href="storage/project_files/{{$project->file_path}}" class="btn btn-info" download="true"> Download </a>
                            </li> 
                        @endforeach   
                    </ul>

                     {{$projects->links()}}
                    @else
                       <h3> No Resource Currently Availble </h3>
                    @endif
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
