<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDepartement(Departement $departement)
    {
        $departement->load("Employee");
        return view("admin.content.Departement.index", compact("departement"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.Departement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|max:200|unique:departements,name',
        ]);
        Departement::create($request->all());
        return redirect()->back()->with('success', 'departement create with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        return view('admin.content.Departement.edit', compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departement $departement)
    {
        $this->validate(request(), [
            'name' => "required|unique:departements,name,except" . $departement->id,
        ]);
        $departement->update($request->all());
        return redirect()->route("admin.departement.index")->with("success", "departement edited with success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->back()->with([
            "success" => "departement delete with success"
        ]);
    }
}
