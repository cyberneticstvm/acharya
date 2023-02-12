<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Head;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderByDesc('date')->get();
        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heads = Head::where('category', 'Expense')->get();
        return view('expense.create', compact('heads'));
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
        Expense::create($input);
        return redirect()->route('expense')->with('success', 'Expense Created Successfully!');
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
        $heads = Head::where('category', 'Expense')->get();
        $expense = Expense::find($id);
        return view('expense.edit', compact('heads', 'expense'));
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
        $exp = Expense::find($id);            
        $exp->update($input);
        return redirect()->route('expense')->with('success', 'Expense Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect()->route('expense')->with('success', 'Expense Deleted Successfully!');
    }
}
