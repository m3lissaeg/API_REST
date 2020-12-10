<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function show(Student $student)
    {
        return $student;
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());
        //201 Object created. Useful for the store actions.
        return response()->json($student, 201);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        //200 OK. The standard success code and default option.
        return response()->json($student, 200);
    }

    public function delete(Student $student)
    {
        $student->delete();
        //204 No content. When an action was executed successfully, but there is no content to return.
        return response()->json(null, 204);
    }
}
