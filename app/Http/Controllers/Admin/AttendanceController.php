<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\File;
use App\Models\Schedule;
use App\Services\FilesServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $filesServices;

    public function __construct(FilesServices $filesServices)
    {
        $this->filesServices = $filesServices;
        $this->middleware('permission:add attendance')->only("CreateAttendance");
        $this->middleware('permission:view attendance')->only("RetardAbence", "ViewAttendance");
    }

    public function CreateAttendance(Request $request, Employee $employee)
    {
        $schedule = Schedule::find(1);
        $this->validate($request, [
            "reason" => "required",
            "time" => 'nullable|time_range:' . $schedule->from . ',' . $schedule->to
        ]);
        $Attendance = Attendance::create([
            "employee_id" => $employee->id,
            "status" => $request->status,
            "date" => $request->date,
            "reason" => $request->reason,
        ]);
        if ($request->hasFile("file")) {
            $image = $this->filesServices->uploadFile($request->file, "AttendanceReason");

            $new_file = new File(["url" => $image]);

            $Attendance->Files()->save($new_file);
        }
        return redirect()->back()->with('success', "attensdance create with success");
    }

    public function ViewAttendance(Request $request)
    {
        $startDate = $request->date_debut ? Carbon::parse($request->date_debut)->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->date_fin ? Carbon::parse($request->date_fin)->endOfDay() : Carbon::now()->endOfMonth();

        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $attendanceQuery = Attendance::whereBetween('date', [$startDate, $endDate])->with('employee', 'employee.departement');

        $employees = Employee::query();

        if ($request->has('employee_name')) {
            $employees->where(function ($query) use ($request) {
                $query->where('firstname', 'like', '%' . $request->employee_name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->employee_name . '%');
            });
        }


        if ($request->departement_id) {
            $employees->where('departement_id', intval($request->departement_id));
        }

        $employees = $employees->get();


        $departements = Departement::all();

        return view('admin.content.attendance.view', compact('dates', 'employees', 'departements'));
    }


    public function RetardAbence(Request $request)
    {
        $employees = Employee::all();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        if ($request->has('date_debut') && $request->has('date_fin')) {
            $startDate = Carbon::parse($request->date_debut)->startOfDay();
            $endDate = Carbon::parse($request->date_fin)->endOfDay();
        }

        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $query = Attendance::whereBetween('date', [$startDate, $endDate])
            ->with('employee');

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by employee name
        if ($request->has('employee_name')) {
            $query->whereHas('employee', function ($query) use ($request) {
                $query->where('firstname', 'like', '%' . $request->employee_name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->employee_name . '%');
            });
        }

        $data = $query->paginate(10);

        return view('admin.content.attendance.RetardAbsence', compact('data'));
    }
}
