<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class tareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Tarea::latest()->paginate(3);
        return view('index', ['tareas' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): redirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        //metodo para realizar insert
        Tarea::create($request->all());
        return redirect()->route('tareas.index')->with('success','guardado correctamente');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea): View
    {
        return view('editar', ['tarea' => $tarea]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea): redirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $tarea->update($request->all());
        return redirect()->route('tareas.index')->with('success','actualizado correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success','Eliminado correctamente');
    }
}
