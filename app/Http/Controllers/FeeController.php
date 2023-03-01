<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentBatch;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Month;
use App\Models\Year;
use App\Models\Fee;
use App\Models\Settings;
use Exception;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fee::orderByDesc('id')->get();
        return view('fee.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $student = Student::findOrFail($id);
        $batch = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = Year::all();
        return view('fee.create', compact('student', 'batch', 'months', 'years'));
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
            'paid_date' => 'required',
            'student' => 'required',
            'batch' => 'required',
            'fee_month' => 'required',
            'fee_year' => 'required',
            'discount_applicable' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $batch = Batch::find($request->batch);
        $fee = $batch->fee;
        $settings = Settings::where('branch', $request->user()->branch)->first();
        if($request->discount_applicable == 1 && $settings->batch_fee_discount_percentage > 0):
            $input['fee'] = $fee - (($fee*$settings->batch_fee_discount_percentage)/100);
        else:
            $input['fee'] = $fee;
        endif;
        try{
            Fee::create($input);
        }catch(Exception $e){
            return redirect()->back()->with('error', "Selected month fee already been paid")->withInput($request->all());
        }        
        return redirect()->route('fee.show')->with('success', 'Fee Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'student' => 'required',
        ]);
        $student = Student::findOrFail($request->student);
        return redirect()->route('fee.show')->with(['success' => 'Data fetched successfully', 'student' => $student])->withInput($request->all);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee = Fee::find($id);
        $student = Student::find($fee->student);
        $batch = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = Year::all();
        return view('fee.edit', compact('fee', 'student', 'batch', 'months', 'years'));
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
            'paid_date' => 'required',
            'student' => 'required',
            'batch' => 'required',
            'fee_month' => 'required',
            'fee_year' => 'required',
            'discount_applicable' => 'required',
        ]);
        $input = $request->all();
        $fees = Fee::find($id);
        $input['updated_by'] = $request->user()->id;
        $batch = Batch::find($request->batch);
        $fee = $batch->fee;
        $settings = Settings::where('branch', $request->user()->branch)->first();
        if($request->discount_applicable == 1 && $settings->batch_fee_discount_percentage > 0):
            $input['fee'] = $fee - (($fee*$settings->batch_fee_discount_percentage)/100);
        else:
            $input['fee'] = $fee;
        endif;
        $fees->update($input);
        return redirect()->route('fee.show')->with('success', 'Fee Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fee::find($id)->delete();
        return redirect()->route('fee.show')->with('success', 'Fee Deleted Successfully!');
    }
}
