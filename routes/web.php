<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\StudentBatchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\BatchSyllabusController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::post('/', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['web', 'auth', 'admin']], function(){

    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/create', [BranchController::class, 'store'])->name('branch.save');
    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/edit/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/delete/{id}', [BranchController::class, 'destroy'])->name('branch.delete');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.save');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/settings', [AdminController::class, 'show'])->name('settings.show');
    Route::put('/settings/{id}', [AdminController::class, 'update'])->name('settings.update');

    Route::get('/studentregchart', [AdminController::class, 'studentregchart'])->name('dash.studentregchart');

});

Route::group(['middleware' => ['web', 'auth']], function(){

    Route::get('/dash', [UserController::class, 'dash'])->name('dash');

    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student/create', [StudentController::class, 'store'])->name('student.save');
    Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/edit/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');

    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/create', [CourseController::class, 'store'])->name('course.save');
    Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/edit/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/delete/{id}', [CourseController::class, 'destroy'])->name('course.delete');

    Route::get('/batch', [BatchController::class, 'index'])->name('batch');
    Route::get('/batch/create', [BatchController::class, 'create'])->name('batch.create');
    Route::post('/batch/create', [BatchController::class, 'store'])->name('batch.save');
    Route::get('/batch/edit/{id}', [BatchController::class, 'edit'])->name('batch.edit');
    Route::put('/batch/edit/{id}', [BatchController::class, 'update'])->name('batch.update');
    Route::delete('/batch/delete/{id}', [BatchController::class, 'destroy'])->name('batch.delete');

    Route::get('/syllabus-status', [BatchSyllabusController::class, 'show'])->name('syllabus.show');
    Route::post('/syllabus-status', [BatchSyllabusController::class, 'fetch'])->name('syllabus.fetch');
    Route::get('/syllabus-status/update', [BatchSyllabusController::class, 'update'])->name('syllabus.update');
    Route::get('/getDropDown', [AdminController::class, 'getDropDown'])->name('getDropDown');

    Route::get('/syllabus', [SyllabusController::class, 'index'])->name('syllabus');
    Route::get('/syllabus/create', [SyllabusController::class, 'create'])->name('syllabus.create');
    Route::post('/syllabus/create', [SyllabusController::class, 'store'])->name('syllabus.save');
    Route::get('/syllabus/edit/{id}', [SyllabusController::class, 'edit'])->name('syllabus.edit');
    Route::put('/syllabus/edit/{id}', [SyllabusController::class, 'update'])->name('syllabus.update');
    Route::delete('/syllabus/delete/{id}', [SyllabusController::class, 'destroy'])->name('syllabus.delete');

    Route::get('/student-batch/create', [StudentBatchController::class, 'create'])->name('student.batch.create');
    Route::post('/student-batch/create', [StudentBatchController::class, 'store'])->name('student.batch.save');

    Route::get('/student-batch', [StudentBatchController::class, 'index'])->name('student.batch');
    Route::get('/student-batch/edit/{id}', [StudentBatchController::class, 'edit'])->name('student.batch.edit');
    Route::put('/student-batch/edit/{id}', [StudentBatchController::class, 'update'])->name('student.batch.update');
    Route::delete('/student-batch/delete/{id}', [StudentBatchController::class, 'destroy'])->name('student.batch.delete');

    Route::get('/fee', [FeeController::class, 'index'])->name('fee.show');
    Route::post('/fee', [FeeController::class, 'show'])->name('fee.fetch');
    Route::get('/fee/create/{id}', [FeeController::class, 'create'])->name('fee.create');
    Route::post('/fee/create', [FeeController::class, 'store'])->name('fee.save');
    Route::get('/fee/edit/{id}', [FeeController::class, 'edit'])->name('fee.edit');
    Route::put('/fee/edit/{id}', [FeeController::class, 'update'])->name('fee.update');
    Route::delete('/fee/delete/{id}', [FeeController::class, 'destroy'])->name('fee.delete');

    Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
    Route::post('/attendance', [AttendanceController::class, 'createemptyattendance'])->name('attendance.sheet.create');
    Route::get('/updateAttendance', [AttendanceController::class, 'updateAttendance'])->name('updateAttendance');

    Route::get('/head', [HeadController::class, 'index'])->name('head');
    Route::get('/head/create', [HeadController::class, 'create'])->name('head.create');
    Route::post('/head/create', [HeadController::class, 'store'])->name('head.save');
    Route::get('/head/edit/{id}', [HeadController::class, 'edit'])->name('head.edit');
    Route::put('/head/edit/{id}', [HeadController::class, 'update'])->name('head.update');
    Route::delete('/head/delete/{id}', [HeadController::class, 'destroy'])->name('head.delete');

    Route::get('/income', [IncomeController::class, 'index'])->name('income');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income/create', [IncomeController::class, 'store'])->name('income.save');
    Route::get('/income/edit/{id}', [IncomeController::class, 'edit'])->name('income.edit');
    Route::put('/income/edit/{id}', [IncomeController::class, 'update'])->name('income.update');
    Route::delete('/income/delete/{id}', [IncomeController::class, 'destroy'])->name('income.delete');

    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense/create', [ExpenseController::class, 'store'])->name('expense.save');
    Route::get('/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('/expense/edit/{id}', [ExpenseController::class, 'update'])->name('expense.update');
    Route::delete('/expense/delete/{id}', [ExpenseController::class, 'destroy'])->name('expense.delete');

    Route::get('/report/daybook', [ReportController::class, 'daybook'])->name('report.daybook');
    Route::post('/report/daybook', [ReportController::class, 'fetchdaybook'])->name('report.daybook.fetch');
    Route::get('/report/fee', [ReportController::class, 'fee'])->name('report.fee');
    Route::post('/report/fee', [ReportController::class, 'fetchfee'])->name('report.fee.fetch');
    Route::get('/report/fee-pending', [ReportController::class, 'feepending'])->name('report.feepending');
    Route::post('/report/fee-pending', [ReportController::class, 'fetchfeepending'])->name('report.feepending.fetch');
    Route::get('/report/attendance', [ReportController::class, 'attendance'])->name('report.attendance');
    Route::post('/report/attendance', [ReportController::class, 'fetchattendance'])->name('report.attendance.fetch');
    Route::get('/report/student', [ReportController::class, 'student'])->name('report.student');
    Route::post('/report/student', [ReportController::class, 'fetchstudent'])->name('report.student.fetch');

    Route::get('/pdf/admission-fee/{id}', [PDFController::class, 'admissionfee'])->name('admissionfee');
    Route::get('/pdf/batch-fee/{id}', [PDFController::class, 'batchfee'])->name('batchfee');

    Route::get('/email/admission-fee/{id}', [PDFController::class, 'emailadmissionfee'])->name('emailadmissionfee');
    Route::get('/email/batch-fee/{id}', [PDFController::class, 'emailbatchfee'])->name('emailbatchfee');
});

