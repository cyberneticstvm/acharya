<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class AdminController extends Controller
{
    public function show(){
        $branch = Auth::user()->branch;
        $settings = Settings::where('branch', $branch)->first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request, $id){
        $branch = Auth::user()->branch;
        $this->validate($request, [
            'admin_name' => 'required|unique:settings,admin_name,'.$id,
            'admin_email' => 'required|email:filter|unique:settings,admin_email,'.$id,
            'batch_fee_discount_percentage' => 'required|numeric',
        ]);
        $input = $request->except(array('_method', '_token'));
        $input['branch'] = $branch;
        Settings::upsert($input, ['branch']);
        return redirect()->route('settings.show')->with('success', 'Settings Updated Successfully!');
    }
}
