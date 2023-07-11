<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Todo;


class ToDosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all current user todos
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('todo.index')->with('todos', $user->todos()->orderByDesc('created_at')->get());
    }

    // Store todos to current user
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required|min:3',
        ]); 
            
        $formFields = $request->all();
        
        $formFields['user_id'] = auth()->id();

        Todo::create($formFields);

        return redirect('/')->with('message', 'To do created successfully!');
    }

    // Show one item
    public function show(Todo $id) {
        // dd($todo);
        $todo = Todo::find($id);
        if(! $todo) {
            return redirect('/')->with('error', 'This to do not exist!');
        }

        return view('todo.show')->with('todo', $id);
    }

    // Show edit form
    public function edit(Todo $id) {
        $todo = Todo::find($id);

        return view('todo.edit')->with('todo', $id);
    } 

    // Update status todo to current user
    public function updateStatus(Request $request, Todo $todo) {
        // dd($request->all());
        
        // Make sure logged in user is owner
        if($request->todo_user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $todo = Todo::find($request->todo_id);

        if($request->status == "Completed!") {
            $todo->status = 'Uncompleted!';
        } else {
            $todo->status = 'Completed!';
        }
        $todo->save();
        
        return back()->with('success', 'To do\'s status updated successfully!');
    }

    // Update to do
    public function update(Request $request) {
        // dd($request->all());
        $todo = Todo::find($request->todo_id);
        // Make sure logged in user is owner
        if($request->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required|min:2',
            'description' => ''
        ]);
        // dd($formFields);

        // $todo->save();
        $todo->update($formFields);

        return redirect('/')->with('message', 'To do updated successfully!');

    }

    // Delete todos to currrent user
    public function destroy(Request $request) {
        $todo = Todo::find($request->todo_id);
        $todo->delete();
        
        return redirect('/')->with('error', 'To do deleted successfully!');
    }
}