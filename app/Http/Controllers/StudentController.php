<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create()
    {
        return view('addstudent');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idnum' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'extname' => 'required',
            'course' => 'required',
            'year' => 'required',
            'block' => 'required',
        ]);

        $student = new Student();
        $student->id = $request->idnum;
        $student->lastname = $request->lastname;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->extname = $request->extname;
        $student->course = $request->course;
        $student->year = $request->year;
        $student->block = $request->block;
        $student->save();

        // Generate QR code here if needed

        return redirect()->route('student_info');
    }
    public function student_info(Request $request)
    {
        $result_per_page = 10;
        $query = Student::query();
        
        $resultRows = $query->count();
        $number_of_page = ceil($resultRows / $result_per_page);
        
        $page = $request->input('page', 1);
        $first_page_number = ($page - 1) * $result_per_page;
        
        $query->orderBy('lastname', 'ASC')
              ->offset($first_page_number)
              ->limit($result_per_page);
        
        $search = $request->input('search', '');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'LIKE', '%' . $search . '%')
                  ->orWhere('lastname', 'LIKE', '%' . $search . '%')
                  ->orWhere('id', 'LIKE', '%' . $search . '%')
                  ->orWhere('course', 'LIKE', '%' . $search . '%')
                  ->orWhere('year', 'LIKE', '%' . $search . '%')
                  ->orWhere('block', 'LIKE', '%' . $search . '%');
            });
        }
        
        $records = $query->get();
        
        return view('student_info', compact('records', 'number_of_page', 'search'));
        
    }
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('student_info')->with('success', 'Student Record deleted successfully');
    }
    
}
