<?php

namespace App\Http\Controllers;

use App\Department;
use App\Task;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function edit($id)
    {
        $tasks = Task::all();
        $department = Department::find($id);
        return view('tasks.department-edit', compact('department', 'tasks'));
    }

    public function create(Request $request)
    {
        return view('tasks.department-create');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'department_name' => 'required',
        ]);

        $department = Department::find($id);
        $department->name = $request->get('department_name');
        $department->updated_at = date("Y-m-d H:i:s");
        $department->save();
        return redirect('tasks/admin/settings')->with('success', 'Department is updated');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
        ]);
        $department = new Department([
            'name' => $request->get('department_name'),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $department->save();
        return redirect('tasks/admin/settings')->with('success', 'Department has been added');
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect('tasks/admin/settings')->with('success', 'Department has been deleted Successfully');
    }
}
