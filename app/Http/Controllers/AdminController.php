<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Student;
use App\Models\Syllabus;
use App\Models\Fee;
use Carbon\Carbon;
use DB;

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

    public function getDropDown(Request $request){
        $id = $request->bid;
        $syls = DB::table('batch_syllabs')->select('syllabus')->where('batch', $id)->pluck('syllabus');
        $data = Syllabus::whereIn('id', $syls)->select('id', 'name')->get();
        $op = "<option value=''>Select</option>";
        foreach($data as $key => $val):
            $op .= "<option value='".$val->id."'>".$val->name."</option>";
        endforeach;
        echo $op;
    }

    public function studentregchart(){
        $students = DB::select("SELECT date, CONCAT_WS('-', SUBSTRING(MONTHNAME(date), 1, 3), DATE_FORMAT(date, '%y')) AS mname, COUNT(s.id) AS ptot FROM (
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AS date UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 2 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 3 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 4 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 5 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 6 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 7 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 8 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 9 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 10 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 11 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 12 MONTH
		) AS dates
		LEFT JOIN students s ON s.created_at >= date AND s.created_at < date + INTERVAL 1 MONTH GROUP BY date");
        return json_encode($students);
    }

    public function studentfeechart(){
        $afee = Student::whereMonth('created_at', Carbon::now()->month)->sum('fee');
        $bfee = Fee::whereMonth('paid_date', Carbon::now()->month)->sum('fee');
        $income = Income::whereMonth('date', Carbon::now()->month)->sum('amount');
        $expenses = Expense::whereMonth('date', Carbon::now()->month)->sum('amount');
        return array('afee' => $afee, 'bfee' => $bfee, 'income' => $income, 'expense' => $expenses);
    }

    public function studentcancelledchart(){
        $students = DB::select("SELECT date, CONCAT_WS('-', SUBSTRING(MONTHNAME(date), 1, 3), DATE_FORMAT(date, '%y')) AS mname, COUNT(CASE WHEN s.cancelled = 1 THEN s.id END) AS ptot FROM (
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AS date UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 2 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 3 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 4 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 5 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 6 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 7 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 8 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 9 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 10 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 11 MONTH UNION ALL
		    SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 12 MONTH
		) AS dates
		LEFT JOIN student_batches s ON s.created_at >= date AND s.created_at < date + INTERVAL 1 MONTH GROUP BY date");
        return json_encode($students);
    }
}
