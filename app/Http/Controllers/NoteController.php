<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:view note")->only("index");
        $this->middleware("permission:create note")->only("create",'store');
        $this->middleware("permission:edit note")->only("edit",'update');
        $this->middleware("permission:delete note")->only("destroy");
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Note::getData($request);
        return view('admin.content.note.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, Note::$rules);
        Note::create($request->all());
        return redirect()->route('admin.notes.index')->with('success', "data create with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('admin.content.note.show',compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('admin.content.note.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $this->validate($request, Note::$rules);
        $note->update($request->all());
        return redirect()->route('admin.notes.index')->with('success', "data update with success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('admin.notes.index')->with('success', "data delete with success");
    }
}
