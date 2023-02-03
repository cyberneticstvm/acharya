<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
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
        Student::create($input);
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
        return view('student.edit', compact('student'));
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
        ]);
        $input = $request->all();
        $student = Student::find($id);
        if($request->hasFile('photo')):
            $img = $request->file('photo');
            $fname = 'photos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['photo'] = $img->getClientOriginalName();                                 
        endif;
        $input['updated_by'] = Auth::user()->id;        
        $student->update($input);
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
