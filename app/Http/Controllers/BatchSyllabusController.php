<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Module;
use App\Models\BatchSyllabus;
use Carbon\Carbon;

class BatchSyllabusController extends Controller
{
    public function show(){
        return view('batch-syllabus.index');
    }

    public function fetch(Request $request){
        $this->validate($request, [
            'batch' => 'required',
        ]);
        $batch = Batch::find($request->batch);
        if($batch):
            $modules = BatchSyllabus::where('batch', $batch->id)->get();
            if($modules->isEmpty()):
                $modules = Module::where('syllabus', $batch->syllabus)->get();
                $data = [];
                foreach($modules as $key => $mod):
                    $data [] = [
                        'batch' => $batch->id,
                        'module' => $mod->id,
                        'status' => 0,
                        'created_by' => $request->user()->id,
                        'updated_by' => $request->user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                BatchSyllabus::insert($data);
                $modules = BatchSyllabus::where('batch', $request->batch)->get();
            endif;
            return redirect()->back()->with(['modules' => $modules])->withInput($request->all());
        else:
            return redirect()->back()->with('error', 'Batch is either expired or not found!')->withInput($request->all());
        endif;
    }

    public function update(Request $request){
        $mid = $request->mid; $val = $request->val;
        $module = BatchSyllabus::find($mid);
        $module->where('id', $mid)->update(['status' => $val]);
        echo "Status updated succesfully!";
    }
}
