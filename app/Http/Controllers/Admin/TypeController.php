<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Type::where("parent_id" , null)->paginate(10);
        return view("admin.content.types.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::where("parent_id" , null)->get();
        // dd($types->count("id"));
        return view("admin.content.types.create",compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            "name" => "required|unique:types,name",
        ]);
        $data = $request->all();
        Type::create($data);
        return redirect()->route("admin.types.index")->with("success", "type created with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $types = Type::where("parent_id" , null)->get();
        return view('admin.content.types.edit', compact('type' , "types"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $this->validate($request, [
            'name' => 'required|unique:types,name,' . $type->id,
        ]);
        $type->update($request->all());
        return redirect()->route("admin.types.index")->with("success", "type edited with success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route("admin.types.index")->with("success", "type deleted with success");
    }
}
