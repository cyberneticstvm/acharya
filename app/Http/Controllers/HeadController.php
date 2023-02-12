<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Head;

class HeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = Head::all();
        return view('iehead.index', compact('heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('iehead.create');
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
            'name' => 'required|unique:heads,name',
            'category' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;        
        $input['updated_by'] = $request->user()->id;        
        Head::create($input);
        return redirect()->route('head')->with('success', 'Head Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $head = Head::find($id);
        return view('iehead.edit', compact('head'));
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
            'name' => 'required|unique:heads,name,'.$id,
            'category' => 'required',
        ]);
        $input = $request->all();
        $head = Head::find($id);        
        $input['updated_by'] = $request->user()->id;        
        $head->update($input);
        return redirect()->route('head')->with('success', 'Head Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Head::find($id)->delete();
        return redirect()->route('head')->with('success', 'Head Deleted Successfully!');
    }
}
