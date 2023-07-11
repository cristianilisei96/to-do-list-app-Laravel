@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">To do: #{{$todo->id}}</div>
                <div class="card-body">
                    @include('inc.messages')
                    <label for="title" class="form-label">Title:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="title" aria-describedby="basic-addon3"
                            value="{{$todo->title}}" disabled />
                    </div>
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" disabled>{{$todo->description}}</textarea>
                </div>
            </div>
            <a href="/" class="btn btn-dark">Back</a>
        </div>
    </div>
</div>
@endsection