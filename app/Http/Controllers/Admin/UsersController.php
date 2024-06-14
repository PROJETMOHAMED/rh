<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user')->only('index');
        $this->middleware('permission:create user')->only('create', "store");
        $this->middleware('permission:edit user')->only('edit', "update");
        $this->middleware('permission:delete user')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view("admin.content.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departement::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.content.users.create', compact('roles', "departements", 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = $request->role;
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ])->assignRole($role);

        foreach ($request->permission as $item) {
            $user->givePermissionTo($item);
        }

        if ($request->has('departements')) {
            $departments = $request->departements;
            $user->departements()->attach($departments);
        }


        return redirect()->route('admin.users.index')->with('success', 'user create with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $departements = Departement::all();
        return view('admin.content.users.edit', compact('roles', 'permissions', 'user', "departements"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        //dEPARTEMENT ASYNC SECTION
        if ($request->has('departements')) {
            $departments = $request->departements;
            $user->departements()->sync($departments);
        }
        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }
        $role = $request->input('role');
        if ($role) {
            $user->syncRoles([$role]);
        }
        $permissions = $request->input('permission', []);
        $user->syncPermissions($permissions);
        return redirect()->route('admin.users.index')->with('success', 'user update with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'user delete with success');
    }
}
