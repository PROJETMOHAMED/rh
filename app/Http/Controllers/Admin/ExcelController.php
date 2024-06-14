<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceEmployeesExport;
use App\Exports\DepartementExport;
use App\Exports\ExportEmployeeAttendance;
use App\Exports\ExportEmployeeRaport;
use App\Exports\ExportEmployees;
use App\Exports\ExportNotes;
use App\Exports\ExportTasks;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\Note;
use App\Models\Task;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function GetRetardAbsenceOfEmployee(Employee $employee)
    {
        $data = Attendance::where('employee_id', $employee->id)->with('employee')->get();
        $filename = $data->first()->employee->firstname . '-' . $data->first()->employee->last_name . '-Attendance';
        return Excel::download(new ExportEmployeeAttendance($data), $filename . '.xlsx');
    }

    public function ExportEmployeesAttendance(Request $request)
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

        $data = [
            'employees' => $employees,
            'dates' => $this->generateDateRange($startDate, $endDate),
        ];

        $formattedStartDate = $startDate->format('Y-m-d');
        $formattedEndDate = $endDate->format('Y-m-d');

        $filename = "attendance-on-" . $formattedStartDate . '-to-' . $formattedEndDate;

        return Excel::download(new AttendanceEmployeesExport($data), $filename . '.xlsx');
    }

    private function generateDateRange($startDate, $endDate)
    {
        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }
        return $dates;
    }

    public function ExportDepartement()
    {
        $data = Departement::all();
        return Excel::download(new DepartementExport($data), 'departementList.xlsx');
    }
    public function ExportEmployees()
    {
        $data = Employee::all();
        return Excel::download(new ExportEmployees($data), 'employeesList.xlsx');
    }
    public function ExportNotes()
    {
        $data = Note::all();
        return Excel::download(new ExportNotes($data), 'NotesList.xlsx');
    }
    public function ExportTasks(Request $request)
    {
        $data = Task::getData($request);
        return Excel::download(new ExportTasks($data), 'TaskList.xlsx');
    }
    public function GetEmployeeRaport(Employee $employee)
    {
        $employee->load(["departement", "Tasks", 'Attendance']);
        $filename = $employee->full_name . "-finalRaport";
        return Excel::download(new ExportEmployeeRaport($employee), $filename . '.xlsx');
    }
}
