<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Syllabus;
use App\Models\Module;
use App\Models\BatchSyllabus;
use Carbon\Carbon;

class BatchSyllabusController extends Controller
{
    public function show(){
        $batches = Batch::where('status', 1)->orderBy('name')->get();
        $syllabi = Syllabus::orderBy('name')->get();
        return view('batch-syllabus.index', compact('batches', 'syllabi'));
    }

    public function fetch(Request $request){
        $this->validate($request, [
            'batch' => 'required',
            'syllabus' => 'required',
        ]);
        $modules = BatchSyllabus::where('batch', $request->batch)->where('syllabus', $request->syllabus)->get();
        if($modules->isEmpty()):
            $modules = Module::where('syllabus', $request->syllabus)->get();
            $data = [];
            foreach($modules as $key => $mod):
                $data [] = [
                    'batch' => $request->batch,
                    'syllabus' => $mod->syllabus,
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
    }

    public function update(Request $request){
        $mid = $request->mid; $val = $request->val;
        $module = BatchSyllabus::find($mid);
        $module->where('id', $mid)->update(['status' => $val]);
        echo "Status updated succesfully!";
    }
}
