<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branch.create');
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
            'name' => 'required|unique:branches,name',
            'email' => 'required|email:filter|unique:branches,email',
            'mobile' => 'required|numeric|digits:10|unique:branches,mobile',
            'address' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('logo')):
            $img = $request->file('logo');
            $fname = 'logos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['logo'] = $img->getClientOriginalName();                                 
        endif;        
        Branch::create($input);
        return redirect()->route('branch')->with('success', 'Branch Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('branch.edit', compact('branch'));
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
            'name' => 'required|unique:branches,name,'.$id,
            'email' => 'required|email:filter|unique:branches,email,'.$id,
            'mobile' => 'required|numeric|digits:10|unique:branches,mobile,'.$id,
            'address' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('logo')):
            $img = $request->file('logo');
            $fname = 'logos/'.$img->getClientOriginalName();
            Storage::disk('public')->putFileAs($fname, $img, '');
            $input['logo'] = $img->getClientOriginalName();                                 
        endif;
        $branch = Branch::find($id);
        $branch->update($input);
        return redirect()->route('branch')->with('success', 'Branch Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::find($id)->delete();
        return redirect()->route('branch')->with('success', 'Branch Deleted Successfully!');
    }
}
