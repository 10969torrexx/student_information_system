<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('role', 0)->get();
        $classes = Classes::all();
        return view('student.index', compact('students', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $student = User::where('id', $request->id)->update([
            'classess_id' => $request->class_id
        ]);
        
        if($student) {
            return response()->json([
                'status' => 200,
                'message' => 'Student updated successfully',
                'data' => $student
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => 'Student update failed',
            'data' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
