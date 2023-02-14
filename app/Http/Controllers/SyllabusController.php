<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Syllabus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syllabi = Syllabus::all();
        return view('syllabus.index', compact('syllabi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('syllabus.create');
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
            'name' => 'required|unique:syllabi,name',
            'module_name' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;        
        $input['updated_by'] = $request->user()->id;
        $syl = Syllabus::create($input);
        $modules = explode(',', $request->module_name);
        foreach($modules as $key => $mod):
            $data [] = [
                'syllabus' => $syl->id,
                'name' => $mod,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        endforeach;        
        DB::table('modules')->insert($data);
        return redirect()->route('syllabus')->with('success', 'Syllabus Created Successfully!');
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
        $syllabus = Syllabus::find($id);
        return view('syllabus.edit', compact('syllabus'));
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
            'name' => 'required|unique:syllabi,name,'.$id,
            'module_name' => 'required',
        ]);
        $input = $request->all();        
        $input['updated_by'] = $request->user()->id;
        $syl = Syllabus::find($id);
        $syl->update($input);
        Module::where('syllabus', $id)->delete();
        $modules = explode(',', $request->module_name);
        foreach($modules as $key => $mod):
            $data [] = [
                'syllabus' => $id,
                'name' => $mod,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        endforeach;        
        DB::table('modules')->insert($data);
        return redirect()->route('syllabus')->with('success', 'Syllabus Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Syllabus::find($id)->delete();
        return redirect()->route('syllabus')->with('success', 'Syllabus Deleted Successfully!');
    }
}
