<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class SwitchController extends Controller
{
    public function SwitchEmployeeActiveMode(Request $request, Employee $employee)
    {
        $employee->status = $request->status;

        $employee->save();

        return redirect()->back()->with('status', 'Employee mode switched successfully.');
    }

    public function SwitchAttendanceStatus(Attendance $attendance, Request $request)
    {
        $status = intval($request->status);
        if ($status == 0) {
            $attendance->delete();
        } else {
            $attendance->status = $status;
            $attendance->save();
        }
        return redirect()->back()->with('success', 'attendance update with success');
    }
    public function SwitchTaskStatus(Task $task, Request $request)
    {
        $status = intval($request->status);
        $task->status = $status;
        $task->save();
        return redirect()->back()->with('success', "Task status update with success");
    }
}
