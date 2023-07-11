@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Edit to do: #{{$todo->id}}</div>
                <div class="card-body">
                    @include('inc.messages')
                    <form method="POST" action="/{{$todo->id}}">
                        @csrf
                        @method('PUT')
                        <label for="title" class="form-label">Title:</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="title" name="title"
                                aria-describedby="basic-addon3" value="{{$todo->title}}" />
                        </div>
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description"
                            name="description">{{$todo->description}}</textarea>
                        <input type="hidden" name="todo_id" value="{{$todo->id}}">
                        <input type="hidden" name="user_id" value="{{$todo->user_id}}">
                        <button class="btn btn-success mt-3 float-end">Edit</button>
                    </form>
                </div>
            </div>
            <a href="/" class="btn btn-dark">Back</a>
        </div>
    </div>
</div>
@endsection