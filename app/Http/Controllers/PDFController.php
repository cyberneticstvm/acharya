<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Mail;
use PDF;
use DB;

class PDFController extends Controller
{
    public function admissionfee($id){
        $student = Student::find($id);     
        $pdf = PDF::loadView('/PDFs/admission-fee', compact('student'));    
        return $pdf->stream($student->name.'.pdf', array("Attachment"=>0));
    }

    public function emailadmissionfee($id){
        $student = Student::find($id);     
        $pdf = PDF::loadView('/PDFs/admission-fee', compact('student'));
        Mail::send('email.admission-fee-receipt', ['student' => $student], function($message) use ($student, $pdf) {
            $message->to($student->email, $student->name)
                    ->subject("Admission Fee Receipt - Acharya")
                    ->attachData($pdf->output(), $student->name.".pdf");
        });
        return redirect()->back()->with('success','Receipt emailed successfully!');
    }
}
