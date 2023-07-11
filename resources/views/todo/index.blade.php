@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">To do: <span class="fw-bold">{{$todos->count()}}</span></div>
                <div class="card-body">
                    @include('inc.messages')

                    <form method="POST" action="/todos">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control mb-2" name="title" value="{{old('title')}}" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="title">Description:</label>
                                <textarea name="description" id="description" row="1" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    @if(count($todos) > 0)
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="th">NO</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo)
                            <tr>
                                <td>{{$todo->id}}</td>
                                <td>{{$todo->title}}</td>
                                <td>{{$todo->description}}</td>
                                <td>
                                    <form method="POST" action="/todos">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="todo_id" value="{{$todo->id}}">
                                        <input type="hidden" name="todo_user_id" value="{{$todo->user_id}}">
                                        <input type="hidden" name="status" value={{$todo->status}}>
                                        <button type="submit" class="{{$todo->status === "Uncompleted!"
                                            ? "btn btn-warning" : "btn btn-success" }}">{{$todo->status}}</button>
                                    </form>
                                </td>
                                <td>

                                    <form method="POST" action="/todos" class="btn-group">
                                        <a href="/{{$todo->id}}"
                                            class="btn btn-primary text-white text-decoration-none">View</a>
                                        <a href="/{{$todo->id}}/edit"
                                            class="btn btn-warning text-dark text-decoration-none">Edit</a>

                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="todo_id" value="{{$todo->id}}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @else
                    <hr>
                    <h5 class="mb-0">No to do founs</h5>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection