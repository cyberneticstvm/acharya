<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\StudentBatch;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{
    public function attendance(){
        $sheet = Attendance::where('date', Carbon::today());
        return view('attendance.index', compact('sheet'));
    }

    public function createemptyattendance(Request $request){
        $this->validate($request, [
            'batch' => 'required',
        ]);
        $batch = Batch::where('status', 1)->where('id', $request->batch)->first();
        if($batch):
            $sheet = Attendance::where('batch', $request->batch)->whereDate('date', Carbon::today())->get();
            if($sheet->isEmpty()):
                $students = StudentBatch::where('batch', $request->batch)->where('cancelled', 0)->get();
                $data = [];
                foreach($students as $key => $student):
                    $data [] = [
                        'student' => $student->student,
                        'batch' => $request->batch,
                        'date' => Carbon::today(),
                        'created_by' => $request->user()->id,
                        'updated_by' => $request->user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                Attendance::insert($data);
                $sheet = Attendance::where('batch', $request->batch)->whereDate('date', Carbon::today())->get();
            endif;
            return redirect()->back()->with(['sheets' => $sheet])->withInput($request->all());
        else:
            return redirect()->back()->with('error', 'Batch is either expired or not found!')->withInput($request->all());
        endif;
    }

    public function updateAttendance(Request $request){
        $col = $request->col; $val = $request->val; $aid = $request->aid;        
        try{
            DB::transaction(function() use ($col, $val, $aid){ 
                $attendance = Attendance::find($aid);
                $attendance->where('id', $aid)->update(['present' => 0, 'absent' => 0, 'leave' => 0]);
                $attendance->where('id', $aid)->update([$col => $val]);
            });
        }catch(Exception $e){
            throw $e;
        }
        echo "Attendance Updated";        
    }
}
