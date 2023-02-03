<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Batch;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::all();
        return view('batch.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('batch.create', compact('courses'));
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
            'name' => 'required|unique:batches,name',
            'course' => 'required',
            'fee' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;        
        $input['updated_by'] = Auth::user()->id;        
        Batch::create($input);
        return redirect()->route('batch')->with('success', 'Batch Created Successfully!');
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
        $courses = Course::all();
        $batch = Batch::find($id);
        return view('batch.edit', compact('courses', 'batch'));
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
            'name' => 'required|unique:batches,name,'.$id,
            'course' => 'required',
            'fee' => 'required',
        ]);
        $input = $request->all();       
        $input['updated_by'] = Auth::user()->id;
        $batch = Batch::find($id);        
        $batch->update($input);
        return redirect()->route('batch')->with('success', 'Batch Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Batch::find($id)->delete();
        return redirect()->route('batch')->with('success', 'Batch Deleted Successfully!');
    }
}
