<?php

// StudentController.php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('standard', 'asc')->paginate(6);
        $page = $students->currentPage();
        return view('students.index', compact('students', 'page'));
    }

    public function create()
    {
        $parents = User::where('role', 'parent')->get();
        return view('students.create', compact('parents'));
    }

    public function edit(Student $student)
    {
        $parents = User::where('role', 'parent')->get();
        return view('students.edit', compact('student', 'parents'));
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }


    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:students', // Fixed unique constraint for students
            'standard' => 'required|string',
            'parent_id' => 'required|string',
        ]);

        // Create the student
        $student = new Student();
        $student->name = $request->name;
        $student->student_id = $request->student_id;
        $student->standard = $request->standard; // Corrected field assignment
        $student->parent_id = $request->parent_id;
        $student->save();

        return redirect()->route('students.create')->with('success', 'Student created successfully.');
    }


    public function update(Request $request, Student $student): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:students,student_id,' . $student->id, // Allow current student ID
            'standard' => 'required|string',
            'parent_id' => 'required|string',
        ]);

        $student->update([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'standard' => $request->standard,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('students.edit', $student->id)->with('success', 'Student updated successfully.');
    }
}
