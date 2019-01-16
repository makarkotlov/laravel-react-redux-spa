<?php

namespace App\Http\Controllers;

use App\Department;
use App\Events\TaskAdded;
use App\Events\TaskDeleted;
use App\Image;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Jobs\ProcessTaskDeleted;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $tasks = Task::all();
        $images = Image::all();
        $user_id = $user->id;
        if ($user->is_admin === 0) {
            $tasks = $tasks->where('developer_id', $user_id);
        }
        return view('tasks.index', compact('tasks', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $departments = Department::all();
        $users = User::all();
        $tasks = Task::all();
        $task = Task::first();
        $user = $task;
        $user = $request->user();
        if ($user->is_admin === 0) {
            $tasks = $tasks->where('developer_id', $user->id);
        }
        return view('tasks.task-create', compact('departments', 'users', 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'developer_id' => 'required',
            'is_urgent' => 'required',
        ]);
        $task = new Task([
            'description' => $request->get('description'),
            'additional_info' => $request->get('additional_info'),
            'author_id' => $request->user()->id,
            'developer_id' => $request->get('developer_id'),
            'is_urgent' => $request->get('is_urgent'), //0 is today, 1 is urgent
            'is_done' => 0,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $task->save();
        $user = $request->user();
        if (empty($request->photos)) {
            broadcast(new TaskAdded($user, $task))->toOthers();
            return redirect('tasks')->with('success', 'Task has been added');
        }
        foreach ($request->photos as $photo) {
            $filepath = $photo->store('img', 'public_files');
            $image = new Image([
                'file_path' => $filepath,
                'task_id' => $task->id,
                'created_at' => date("Y-m-d H:i:s"),
                'sender_id' => $request->user()->id,
                'type' => 'owner',
            ]);
            $image->save();
        }
        broadcast(new TaskAdded($user, $task))->toOthers();
        return redirect('tasks')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $task = Task::find($id);
        if (empty($task)) {
            return redirect()->back()->with('failure', 'Task isn\'t found');
        }
        $user = $request->user();
        $user_id = $user->id;
        if (!($task->developer_id === $user_id || $user->is_admin === 1)) {
            return redirect()->back()->with('failure', 'You\'re not authorized for this');
        }
        $tasks = Task::where('is_done', 0)->get();
        if ($user->is_admin === 0) {
            $tasks = $tasks->where('developer_id', $user_id);
        }
        $images = $task->get_image;
        $adminimages = $images->where('type', 'owner');
        $userimages = $images->where('type', 'employee');
        if ($task->is_done === 1) {
            return view('tasks.task-view-completed', compact('task', 'tasks', 'adminimages', 'userimages'));
        }
        return view('tasks.task-view', compact('task', 'tasks', 'adminimages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        if ($user->is_admin === 0) {
            return redirect('/tasks')->with('failure', 'You\'re not authorized for this');
        }
        $departments = Department::all();
        $users = User::all();
        $task = Task::find($id);
        $tasks = Task::all();
        $images = $task->get_image;
        $adminimages = $images->where('sender_id', 1);
        return view('tasks.task-edit', compact('task', 'departments', 'users', 'tasks', 'adminimages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'developer_id' => 'required',
            'is_urgent' => 'required',
        ]);
        $task = Task::find($id);
        $task->description = $request->get('description');
        $task->is_urgent = $request->get('is_urgent');
        $task->additional_info = $request->get('additional_info');
        $task->developer_id = $request->get('developer_id');
        $task->updated_at = date("Y-m-d H:i:s");
        $task->save();
        if (empty($request->photos)) {
            return redirect('/tasks/' . $task->id)->with('success', 'Task has been updated');
        }

        foreach ($request->photos as $photo) {
            $filepath = $photo->store('img', 'public_files');
            $image = new Image([
                'file_path' => $filepath,
                'task_id' => $task->id,
                'created_at' => date("Y-m-d H:i:s"),
                'sender_id' => $request->user()->id,
                'type' => 'owner',
            ]);
            $image->save();
        }
        return redirect('/tasks/' . $task->id)->with('success', 'Task has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::find($id);
        $user = $request->user();
        $taskArray = $task->toArray();
        broadcast(new TaskDeleted($user, $taskArray))->toOthers();
        foreach ($task->get_image as $image) {
            $filepath = $image->file_path;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
        }
        $task->delete();
        return redirect('tasks')->with('success', 'Task has been deleted Successfully');
    }
}
