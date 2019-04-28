@extends('layout')

@section('content')

<h1 class="title">{{$project->title}}</h1>
<p class="content">{{$project->description}}</p>

<p>
    <a href="/projects/{{$project->id}}/edit">Edit</a>
</p>

@if($project->tasks->count())
    <div class="box">
        @foreach ($project->tasks as $task)
        <div>
            <form method="POST" action="/tasks/{{$task->id}}">
                @method('PATCH')
                @csrf
                
                <label class="checkbox  {{$task->completed ? 'is-complete' : ''}}" for="completed">
                    <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                    {{$task->description}}
                </label>
            </form>
        </div>
        @endforeach
    </div>
@endif

<form class="box"method="POST" action="/projects/{{$project->id}}/tasks">
    @csrf
    <div class="field">
        <label for="description">Add New Task</label>
        <div class="control">
            <input type="text" class="input" name="description" placeholder="New Task" required>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link">Add Task</button>
        </div>
    </div>
</form>

@include ('errors')

@endsection