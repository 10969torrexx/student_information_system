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

    public function myClass()
    {
        $user = User::join('classes', 'users.classess_id', '=', 'classes.id')
            ->where('users.id', Auth::user()->id)->first();
        // dd( $user->toArray());
        return view('classes.myclass', compact('user'));
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
    public function update(Request $request)
    {
        $class = Classes::where('id', $request->id)->update([
            'class_name' => $request->class_name,
            'year_level' => $request->year_level
        ]);
        
        if($class) {
            return redirect()->route('classesIndex')->with('success', 'Class updated successfully');
        }
        return redirect()->route('classesIndex')->with('failed', 'Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $class = Classes::where('id', $request->id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Class deleted successfully',
            'data' => $class
        ]);
    }
}
