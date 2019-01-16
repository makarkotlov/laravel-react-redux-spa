<?php

namespace App\Http\Controllers;

use App\Department;
use App\Image;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function settings(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        if ($user->is_admin === 1) {
            $tasks = Task::where('is_done', 0);
        }

        $tasks = Task::where('developer_id', $user_id);
        $images = Image::all();
        return view('tasks.user-settings', compact('tasks', 'images'));
    }

    public function admin_settings(Request $request)
    {
        $tasks = Task::all();
        $images = Image::all();
        $departments = Department::all();
        $users = User::all();
        return view('tasks.admin-settings', compact('tasks', 'images', 'departments', 'users'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'patronymic' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->patronymic = $request->get('patronymic');
        $user->phone_number = $request->get('phone_number');
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();
        if ($user->is_admin === 1) {
            return redirect('/tasks/admin/settings')->with('success', 'Account is updated');
        }

        return redirect('/tasks')->with('success', 'Account is updated');
    }

    public function superupdate(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'patronymic' => 'required',
            'department_id' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->patronymic = $request->get('patronymic');
        $user->phone_number = $request->get('phone_number');
        $user->updated_at = date("Y-m-d H:i:s");
        $user->department_id = $request->get('department_id');
        $user->email = $request->get('email');
        $user->save();
        return redirect('/tasks/admin/settings')->with('success', 'Account is updated');

    }

    public function edit($id)
    {
        $departments = Department::all();
        $user = User::find($id);
        $tasks = Task::all();
        return view('tasks.user-edit', compact('departments', 'user', 'tasks'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $departments = Department::all();
        $tasks = Task::all();
        return view('tasks.employee-create', compact('departments', 'tasks'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'last_name' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'department_id' => 'required',
            'password' => 'required',
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'patronymic' => $request->get('patronymic'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
            'department_id' => $request->get('department_id'),
            'created_at' => date("Y-m-d H:i:s"),
            'password' => Hash::make($request->get('password')),
            'is_admin' => 0,
        ]);

        $user->save();
        return redirect('tasks/admin/settings')->with('success', 'User has been added');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('tasks/admin/settings')->with('success', 'Employee has been deleted Successfully');
    }

    public function ajax(Request $request)
    {
        $users = User::where('department_id', $request->department)->get();
        return view('tasks.user-foreach', compact('users'));
    }

    public function ajax_for_task_edit(Request $request)
    {
        $users = User::where('department_id', $request->department_id)->get();
        $task = Task::find($request->task_id);
        return view('tasks.task-edit-user-foreach', compact('users', 'task'));
    }

    public function ajax_getusers(Request $request)
    {
        $users = User::where('department_id', $request->department)->where('is_admin', 0)->get();
        return view('tasks.admin-user-foreach', compact('users'));
    }

    public function ajax_getview(Request $request)
    {
        $departments = Department::all();
        $users = User::where('is_admin', 0)->get();
        $id = $request->id;
        $user = User::find($id);
        $admin = $request->user();
        $tasks = Task::all();
        $tasks = $tasks->reverse();
        if ($request->name === 'users') {
            return view('tasks.admin-settings-users', compact('users', 'departments'));
        }

        if ($request->name === 'departments') {
            return view('tasks.admin-settings-departments', compact('departments'));
        }

        if ($request->name === 'account') {
            return view('tasks.admin-account', compact('departments', 'admin'));
        }

        if ($request->name === 'new_department') {
            return view('tasks.department-create');
        }

        if ($request->name === 'user_edit') {
            return view('tasks.user-edit', compact('users', 'user', 'departments'));
        }

        if ($request->name === 'alltasks') {
            return view('tasks.drop-alltasks', compact('tasks'));
        }

        if ($request->name === 'donetasks') {
            return view('tasks.drop-donetasks', compact('tasks'));
        }

        if ($request->name === 'urgenttasks') {
            return view('tasks.drop-urgenttasks', compact('tasks'));
        }

        if ($request->name === 'todaytasks') {
            return view('tasks.drop-todaytasks', compact('tasks'));
        }

    }

    public function ajax_image_delete(Request $request)
    {
        $image = Image::find($request->id);

        if (File::exists($image->file_path)) {
            File::delete($image->file_path);
        }

        $image->delete();
    }

    // public function ajax_upload_image(Request $request)
    // {
    //     dd($request);
    //     $filepath = $request->file->store('img', 'public_files');
    //     $image = new Image([
    //       'file_path' => $filepath,
    //       'task_id' => $task_id,
    //       'created_at' => date("Y-m-d H:i:s"),
    //       'sender_id' => $request->user()->id,
    //       'type' => 'owner'
    //     ]);
    //     $image->save();
    // }

    // public function quicksort(&$arr, $leftIndex, $rightIndex)
    // {
    //     function partition(&$arr,$leftIndex,$rightIndex)
    //     {
    //         $pivot = $arr[($leftIndex + $rightIndex)/2];
    //         while ($leftIndex <= $rightIndex)
    //         {
    //             while ($arr[$leftIndex] < $pivot)
    //                 $leftIndex++;
    //             while ($arr[$rightIndex] > $pivot)
    //                 $rightIndex--;
    //             if ($leftIndex <= $rightIndex)
    //             {
    //                 $tmp = $arr[$leftIndex];
    //                 $arr[$leftIndex] = $arr[$rightIndex];
    //                 $arr[$rightIndex] = $tmp;
    //                 $leftIndex++;
    //                 $rightIndex--;
    //             }
    //         }
    //         return $leftIndex;
    //     }

    //     function sort_it(&$arr, $leftIndex, $rightIndex)
    //     {
    //         $index = partition($arr, $leftIndex, $rightIndex);
    //         if ($leftIndex < $index - 1)
    //             sort_it($arr, $leftIndex, $index - 1);
    //         if ($index < $rightIndex)
    //             sort_it($arr, $index, $rightIndex);
    //     }
    //     sort_it($arr, $leftIndex, $rightIndex);
    // }
}
