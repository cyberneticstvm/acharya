<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Fee;
use App\Models\Month;
use App\Models\Expense;
use App\Models\Student;
use App\Models\StudentBatch;
use DB;

class ReportController extends Controller
{
    public function daybook(){
        $fee = collect();  $income = collect(); $expense = collect(); $inputs = [];
        return view('reports.daybook', compact('fee', 'income', 'expense', 'inputs'));
    }

    public function fetchdaybook(Request $request){
        $this->validate($request, [
            'date' => 'required',
        ]);
        $inputs = array($request->date);
        $fee = Fee::whereDate('paid_date', $request->date)->get();
        $income = Income::whereDate('date', $request->date)->get();
        $expense = Expense::whereDate('date', $request->date)->get();
        return view('reports.daybook', compact('fee', 'income', 'expense', 'inputs'));
    }

    public function fee(){
        $records = collect(); $inputs = [];
        return view('reports.fee', compact('records', 'inputs'));
    }

    public function fetchfee(Request $request){
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $records = Fee::whereBetween('paid_date', [$request->from_date, $request->to_date])->get(); 
        $inputs = array($request->from_date, $request->to_date);
        return view('reports.fee', compact('records', 'inputs'));
    }

    public function feepending(){
        $records = collect(); $inputs = [];
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        return view('reports.fee-pending', compact('records', 'batches', 'months', 'years', 'inputs'));
    }

    public function fetchfeepending(Request $request){
        $this->validate($request, [
            'batch' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        $inputs = array($request->batch, $request->month, $request->year);
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        $records = StudentBatch::where('batch', $request->batch)->get();
        return view('reports.fee-pending', compact('records', 'batches', 'months', 'years', 'inputs'));
    }

    public function attendance(){
        $records = collect(); $inputs = []; $days = 0;
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        return view('reports.attendance', compact('records', 'batches', 'months', 'years', 'inputs', 'days'));
    }

    public function fetchattendance(Request $request){
        $this->validate($request, [
            'batch' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        $inputs = array($request->batch, $request->month, $request->year);
        $batches = Batch::where('status', 1)->get();
        $months = Month::all();
        $years = DB::table('years')->get();
        $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        $records = StudentBatch::where('batch', $request->batch)->get();
        return view('reports.attendance', compact('records', 'batches', 'months', 'years', 'inputs', 'days'));
    }

    public function student(){
        $student = []; $batches = []; $records = []; $inputs = [];
        return view('reports.student', compact('student', 'inputs', 'batches', 'records'));
    }

    public function fetchstudent(Request $request){
        $this->validate($request, [
            'student' => 'required',
        ]);
        $student = Student::find($request->student);
        if($student):
            $batches = Batch::whereIn('id', $student->batches()->pluck('batch'))->pluck('name')->implode(', ');
            $records = StudentBatch::whereIn('batch', $student->batches()->pluck('batch'))->where('student', $request->student)->get();
            $inputs = array($request->student);
            return view('reports.student', compact('student', 'inputs', 'batches', 'records'));
        else:
            return redirect()->back()->with("error", "Student details not found")->withInput($request->all);
        endif;
    }

    public function attendancesummary(){
        $inputs = []; $att = collect(); $batches = Batch::where('status', 1)->get();
        return view('reports.attendance-summary', compact('inputs', 'att', 'batches'));
    }

    public function fetchattendancesummary(Request $request){
        $this->validate($request, [
            'date' => 'required',
            'batch' => 'required',
        ]);
        $inputs = array($request->batch, $request->date); $batches = Batch::where('status', 1)->get();
        $att = Attendance::whereDate('date', $request->date)->where('batch', $request->batch)->get();
        return view('reports.attendance-summary', compact('inputs', 'att', 'batches'));
    }
}
