<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\File;
use App\Models\Note;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\Type;
use App\Models\User;
use App\Services\FilesServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $filesServices;

    public function __construct(FilesServices $filesServices)
    {
        $this->filesServices = $filesServices;
    }

    public function index()
    {
        // get stagiares Count
        $stageType = Type::where('name', 'stage')->whereNull('parent_id')->first();
        $typeIds = $stageType->children()->pluck('id')->push($stageType->id);
        $StagiairesCount = Employee::whereIn('type_id', $typeIds)->where('status', 3)->count();
        //
        $employeeType = Type::where('name', 'Employment Contract')->whereNull('parent_id')->first();
        $typeEmployeesIds = $employeeType->children()->pluck('id')->push($employeeType->id);
        $EmployeesCount = Employee::whereIn('type_id', $typeEmployeesIds)->where('status', 3)->count();
        $counts = [
            'employeesCount' => $EmployeesCount,
            'stagiairesCount' => $StagiairesCount,
            'departmentCount' => Departement::count(),
            'abondoneCount' => Employee::where('status', 2)->count(),
        ];

        // Get Stagiare List Data
        $stageType = Type::where('name', 'stage')->whereNull('parent_id')->first();
        $typeIds = $stageType->children()->pluck('id')->push($stageType->id);
        $stagiaires = Employee::whereIn('type_id', $typeIds)->where('status', 3)->with('ContratType')->orderBy('created_at', 'desc')->take(5)->get();

        //Get Employees List
        $stageType = Type::where('name', 'Employment Contract')->whereNull('parent_id')->first();
        $typeIds = $stageType->children()->pluck('id')->push($stageType->id);
        $employees = Employee::whereIn('type_id', $typeIds)->with('ContratType')->orderBy('created_at', 'desc')->take(5)->get();

        //employees with their late and absence
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $employeesCountLateAbsence = Employee::where('status', 3)->with([
            'departement',
            'Attendance' => function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
            }
        ])
            ->get()
            ->map(function ($employee) {
                $lateCount = $employee->Attendance->where('status', 2)->count();
                $absenceCount = $employee->Attendance->where('status', 1)->count();

                return [
                    'employee' => $employee,
                    'late_count' => $lateCount,
                    'absence_count' => $absenceCount,
                ];
            })
            ->sortByDesc(function ($employeeData) {
                return $employeeData['late_count'] + $employeeData['absence_count'];
            })
            ->take(5);


        $listOfData = [
            'stagiareList' => $stagiaires,
            'employeesList' => $employees,
            "recentEmployees" => Employee::with('ContratType')->latest()
                ->take(5)
                ->get(),
            "recentTasks" => Task::with('employee')->latest()
                ->take(5)
                ->get(),
            "recentNotes" => Note::latest()
                ->take(5)
                ->get(),
            "employeesCountLateAbsence" => $employeesCountLateAbsence
        ];
        return view('admin.index', compact(['counts', "listOfData"]));
    }
    public function DeletePermissionFromUser(User $user, Request $request)
    {
        $user->revokePermissionTo($request->permission);
        return redirect()->back()->with('success', 'Permission Deleted Successfully');
    }

    public function removeDepartment(User $user, Departement $department)
    {
        $user->departements()->detach($department);

        return redirect()->back()->with('success', 'Department removed from user successfully');
    }

    public function WorkTime()
    {
        $data = Schedule::all();
        return view('admin.content.schedule', compact('data'));
    }

    public function EditeWorkTime(Request $request, Schedule $week)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            "stop_from" => "required",
            "stop_to" => "required",
        ]);
        $week->update($request->all());
        return redirect()->back()->with([
            'success' => 'Work Time Updated Successfully'
        ]);
    }
    public function EditReason(Attendance $attendance, Request $request)
    {
        $this->validate($request, [
            "reason" => "required"
        ]);
        $attendance->reason = $request->reason;
        $attendance->update();
        return redirect()->back()->with([
            "success" => "reason edit with success"
        ]);
    }
    public function AddJustification(Attendance $attendance, Request $request)
    {
        $this->validate($request, [
            "file" => "required"
        ]);
        if ($request->hasFile("file")) {
            $image = $this->filesServices->uploadFile($request->file, "AttendanceReason");

            $new_file = new File(["url" => $image]);

            $attendance->Files()->save($new_file);
        }
        return redirect()->back()->with([
            "success" => "reason edit with success"
        ]);
    }
}
