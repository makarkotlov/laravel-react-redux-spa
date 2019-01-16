<?php

namespace App\Http\Controllers;

use App\Image;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class TaskCompleteController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request, $id)
    {
        $user = $request->user();
        $task = Task::find($id);
        if (!($user->id === $task->developer_id)) {
            return redirect()->back()->with('failure', 'The task is no longer yours');
        }

        $request->validate([
            'files[]' => 'required',
        ]);
        if (!empty($request->feedback)) {
            $task->feedback = $request->get('feedback');
        }

        $task->updated_at = date("Y-m-d H:i:s");
        $task->is_done = 1;
        $task->save();
        foreach ($request->photos as $photo) {
            $filepath = $photo->store('img', 'public_files');
            $image = new Image([
                'file_path' => $filepath,
                'task_id' => $task->id,
                'created_at' => date("Y-m-d H:i:s"),
                'sender_id' => $request->user()->id,
                'type' => 'employee',
            ]);
            $image->save();
        }
        return redirect('tasks')->with('success', 'Task completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAllTasks()
    {
        $tasks = Task::all();
        foreach($tasks as $task){
            foreach ($task->get_image as $image) {
                $filepath = $image->file_path;
                if (File::exists($filepath)) {
                    File::delete($filepath);
                }
            }
            $task->delete();
        }
        return redirect('tasks')->with('success', 'Fatality!');
    }
}
