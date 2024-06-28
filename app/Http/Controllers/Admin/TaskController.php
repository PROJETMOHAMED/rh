<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:view task")->only("index");
        $this->middleware("permission:create task")->only("create", "store");
        $this->middleware("permission:edit task")->only("edit", "update");
        $this->middleware("permission:delete task")->only("destroy");
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Task::getData($request);
        return view('admin.content.tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => "required|exists:employees,id",
            'name' => "required|max:200",
            'date_debut' => "required|date",
            'date_fin' => "required|after_or_equal:date_debut",
        ]);
        Task::create($request->all());
        return redirect()->route('admin.tasks.index')->with(['success' => 'task create with success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('admin.content.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('admin.content.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'employee_id' => "required|exists:employees,id",
            'name' => "required|max:200",
            'date_debut' => "required|date",
            'date_fin' => "required|after_or_equal:date_debut",
        ]);
        $task->update($request->all());
        return redirect()->route("admin.tasks.index")->with([
            "success" => "task update with success"
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route("admin.tasks.index")->with([
            "success" => "task delete with success"
        ]);
    }
}
