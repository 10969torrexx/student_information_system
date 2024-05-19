<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClassesController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::all();
        return view('classes.index', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $class = Classes::create([
            'class_name' => $request->class_name,
            'year_level' => $request->year_level
        ]);
        
        return redirect()->route('classesIndex')->with('success', 'Class created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = Classes::find($id);
        $class->delete();
        return redirect()->route('classesIndex')->with('success', 'Class deleted successfully');
    }
}
