<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Batch;
use App\Models\User;
use Hash;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::where('branch', Auth::user()->branch)->orderByDesc('id')->get();
        $batches = Batch::where('status', 1)->get();
        $status = DB::table('status')->where('category', 'student')->get();        
        return view('student.index', compact('students', 'batches', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        return view('student.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email',
            'mobile' => 'required|numeric|digits:10',
            'admission_date' => 'required',
            'address' => 'required',
            'fee' => 'required',
            'branch' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('photo')):
            $img = $request->file('photo');
            $fname = 'photos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['photo'] = $img->getClientOriginalName();                                 
        endif;
        $input['created_by'] = Auth::user()->id;        
        $input['updated_by'] = Auth::user()->id;
        $input['status'] = 'Active';
        $input['branch'] = 1;
        $input['role'] = 'Student';
        $input['password'] = Hash::make($request->mobile);
        DB::transaction(function() use ($input) {
            Student::create($input);
            User::create($input);
        });        
        return redirect()->route('student')->with('success', 'Student Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $branches = Branch::all();
        return view('student.edit', compact('student', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:students,email,'.$id,
            'mobile' => 'required|numeric|digits:10',
            'admission_date' => 'required',
            'address' => 'required',
            'fee' => 'required',
            'branch' => 'required',
        ]);
        $input = $request->all();
        $student = Student::find($id); $user = User::where('email', $student->email)->first();
        if($request->hasFile('photo')):
            $img = $request->file('photo');
            $fname = 'photos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['photo'] = $img->getClientOriginalName();                                 
        endif;
        $input['updated_by'] = Auth::user()->id;
        DB::transaction(function() use ($input, $student, $user) {
            $student->update($input);
            $user->update($input);
        });
        return redirect()->route('student')->with('success', 'Student Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect()->route('student')->with('success', 'Student Deleted Successfully!');
    }
}
