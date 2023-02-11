<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\StudentBatch;
use App\Models\Student;
use App\Models\Batch;
use DB;
use Exception;

class StudentBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sbs = StudentBatch::all();
        return view('student-batch.index', compact('sbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'students' => 'present|array',
            'date_joined' => 'required',
            'batch' => 'required',
            'status' => 'required',
        ]);
        $students = $request->students;
        $data = [];
        foreach($students as $key => $stud):
            $data [] = [
                'student' => $stud,
                'batch' => $request->batch,
                'date_joined' => $request->date_joined,
                'status' => $request->status,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        endforeach;
        try{
            $insert = DB::table('student_batches')->insert($data);
        }catch(Exception $e){
            throw $e;
        }        
        return redirect()->back()->with('success', 'Student Assigned Successfully!');
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
        $sb = StudentBatch::find($id);
        $students = Student::all();
        $batches = Batch::all();
        $status = DB::table('status')->where('category', 'student')->get();
        return view('student-batch.edit', compact('sb', 'students', 'batches', 'status'));
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
            'student' => 'required',
            'date_joined' => 'required',
            'batch' => 'required',
            'status' => 'required',
            'cancelled' => 'required',
        ]);
        $input = $request->all();
        $sb = StudentBatch::find($id);
        try{
            $sb->update($input);
        }catch(Exception $e){
            throw $e;
        }        
        return redirect()->route('student.batch')->with('success', 'Student Batch Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
