@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3> Edit Project</h3>
            <hr>
            {!!Form::open(['method' => 'post', 'action' => ['ProjectController@update', $project->id], 'enctype' => 'multipart/form-data'])!!}
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $project->title, ['class' => 'form form-control mb-3', 'placeholder' => 'Project Title'])}}
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $project->description, ['class' => 'form form-control mb-3', 'placeholder' => 'Project Description'])}}
                {{Form::file('file')}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('update project', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
