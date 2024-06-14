<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Type;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view employee')->only('index');
        $this->middleware('permission:create employee')->only('create', 'store');
        $this->middleware('permission:delete employee')->only('destroy');
        $this->middleware('permission:edit employee')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::latest()->with(['Departement']);

        // Apply the status filter if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->departement) {
            $query->where('departement_id', $request->departement);
        }

        if ($request->has('type')) {
            $type = $request->type;
            if ($type === 'stage') {
                $parentType = Type::where('name', 'stage')->first();

                if ($parentType) {
                    // Get employees whose type or type's parent is 'stage'
                    $query->whereHas('ContratType', function ($q) use ($parentType) {
                        $q->where('parent_id', $parentType->id)
                            ->orWhere('id', $parentType->id);
                    });
                }
            } else if ($type === 'Employment Contract') {
                $parentType = Type::where('name', 'Employment Contract')->first();

                if ($parentType) {
                    // Get employees whose type or type's parent is 'stage'
                    $query->whereHas('ContratType', function ($q) use ($parentType) {
                        $q->where('parent_id', $parentType->id)
                            ->orWhere('id', $parentType->id);
                    });
                }
            }
            $query->where('status',3);
        }

        // Paginate the results
        $data = $query->paginate(10);

        return view('admin.content.emplyees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departement::all();
        $schedules = Schedule::all();
        $types = Type::whereNull('parent_id')->get();
        return view("admin.content.emplyees.create", compact("types", "departements", "schedules"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'piece_identite' => 'required|string',
            'adresse' => 'nullable|string',
            'departement_id' => 'required|exists:departements,id',
            'type_id' => 'required|exists:types,id',
            'sexe' => 'required',
        ]);
        Employee::create($request->all());
        return redirect()->route("admin.employees.index", ['status' => 3])->with("success", "data create with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('admin.content.emplyees.view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departements = Departement::all();
        $schedules = Schedule::all();
        $types = Type::whereNull('parent_id')->get();
        return view('admin.content.emplyees.edit', compact('employee', "departements", "schedules", "types"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'piece_identite' => 'required|string',
            'adresse' => 'nullable|string',
            'departement_id' => 'required|exists:departements,id',
        ]);
        $employee->update($request->all());
        return redirect()->route("admin.employees.index")->with("success", "data edit with success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route("admin.employees.index")->with("success", "employee delete with success");
    }
}
