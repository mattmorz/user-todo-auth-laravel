<?php

namespace App\Http\Controllers;
use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ToDoDeletedMail;

class ToDoController extends Controller
{
    public function index(){
        $todos = ToDo::with('user')->get();
        return view('todos.index',compact('todos'));
    }

    public function create(){
        return view('todos.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required|string|max:255|min:10',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($request->hasFile('icon')){
            $data['icon_path']=$request->file('icon')
                                        ->store('icons','public');
        }
        $data['user_id'] = Auth::id(); // Assign the authenticated user's ID
        ToDo::create([
            'title'=>$data['title'],
            'icon_path' => $data['icon_path'] ?? null,
            'completed' => false,
            'user_id' => $data['user_id'],
        ]);
        return redirect()->route('todos.index')->with('status', 'Todo created successfully!');
    }

    public function show($id){
        $todo = ToDo::findOrFail($id);
        return view('todos.show',compact('todo'));
    }

    public function edit($id){
        $todo = ToDo::findOrFail($id);
        return view('todos.edit',compact('todo'));
    }

    public function update(Request $request,$id){
        $todo = ToDo::findOrFail($id);

        $data = $request->validate([
            'title'=>'required|string|max:255|min:10',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'completed' => 'nullable|boolean',
        ]);

        if($request->hasFile('icon')){
            $data['icon_path']=$request->file('icon')->store('icons','public');
        }

        $todo->update([
            'title'=>$data['title'],
            'icon_path' => $data['icon_path'] ?? $todo->icon_path,
            'completed' => $request->has('completed')? $data['completed'] : $todo->completed,
        ]);

        return redirect()->route('todos.show',$todo->id);
    }

    public function destroy(int $id){
        $todo = ToDo::with('user')->findOrFail($id);

        if($todo->icon_path && \Storage::disk('public')->exists($todo->icon_path)){
            \Storage::disk('public')->delete($todo->icon_path);
        }
        
        if ($todo->user && $todo->user->email) {
            Mail::to($todo->user->email)->send(new ToDoDeletedMail($todo));
        }
    
        $todo->delete();


        return redirect()->route('todos.index')->with('status', "ToDo “{$todo->title}” deleted and owner notified.");  
    }
}