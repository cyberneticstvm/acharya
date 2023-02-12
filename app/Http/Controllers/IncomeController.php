<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Head;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::orderByDesc('date')->get();
        return view('income.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heads = Head::where('category', 'Income')->get();
        return view('income.create', compact('heads'));
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
            'date' => 'required',
            'head' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;        
        $input['updated_by'] = $request->user()->id;        
        $input['branch'] = $request->user()->branch;        
        Income::create($input);
        return redirect()->route('income')->with('success', 'Income Created Successfully!');
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
        $heads = Head::where('category', 'Income')->get();
        $income = Income::find($id);
        return view('income.edit', compact('heads', 'income'));
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
            'date' => 'required',
            'head' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);
        $input = $request->all();        
        $input['updated_by'] = $request->user()->id;  
        $income = Income::find($id);            
        $income->update($input);
        return redirect()->route('income')->with('success', 'Income Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Income::find($id)->delete();
        return redirect()->route('income')->with('success', 'Income Deleted Successfully!');
    }
}
