<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;


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

Route::get('/login', function () {
    return view('login_page');
});
Route::get('show_registration_form',[UserAuthController::class,'show_registration_form'])->name('show_registration_form');
Route::post('add_registration_form',[UserAuthController::class,'add_registration_form'])->name('add_registration_form');
Route::post('/check_login',[UserAuthController::class,'index'])->name('check_login');
Route::post('/add_user_form',[UserAuthController::class,'register_user'])->name('add_user_form');
Route::get('/admin_dashboard',[UserAuthController::class,'Dashboard'])->name('admin_dashboard');
Route::get('/logout',[UserAuthController::class,'session_destroy'])->name('logout');
Route::get('employees',[UserAuthController::class,'employees'])->name('employees');
Route::post('add_employees',[UserAuthController::class,'add_employees'])->name('add_employees');
Route::post('/edit_user_form',[UserAuthController::class,'edit_user'])->name('edit_user_form');
Route::get('/delete_user/{id}',[UserAuthController::class,'delete_user']);
Route::get('clients',[UserAuthController::class,'clients'])->name('clients');
Route::post('add_clients',[UserAuthController::class,'add_clients'])->name('add_clients');

// route for project show 
Route::get('projects',[UserAuthController::class,'projects'])->name('projects');
Route::get('project_show',[UserAuthController::class,'project_show'])->name('project_show');

//delete project 
Route::get('destroy_projects/{p_id}',[UserAuthController::class,'destroy_p'])->name('destroy_projects');

//add project route
Route::get('show_form',[UserAuthController::class,'show_form'])->name('show_form');
Route::get('add_project',[UserAuthController::class,'add_project'])->name('add_project');
Route::post('projects',[UserAuthController::class,'projects'])->name('projects');
Route::get('destroy_projects/{p_id}',[UserAuthController::class,'destroy_projects'])->name('destroy_projects');
Route::get('edit/{p_id}',[UserAuthController::class,'edit'])->name('edit');
Route::POST('update',[UserAuthController::class,'update'])->name('update');
Route::get('abc',[UserAuthController::class,'abc'])->name('abc');
//route for assign project
Route::get('/add_emp',[UserAuthController::class,'add_emp'])->name('add_emp');
Route::post('/emp_store',[UserAuthController::class,'emp_store'])->name('emp_store');


// route for empolyee name get by id

Route::get('assigprojectnempolyee/{p_id}',[UserAuthController::class,'assigprojectnempolyee'])->name('assigprojectnempolyee');
Route::post('project_assign_employee',[UserAuthController::class,'project_assign_employee'])->name('project_assign_employee');
//project remove from empolyee
Route::get('/assign_empolyee_delete/{assign_id}',[UserAuthController::class,'assign_empolyee_delete'])->name('assign_empolyee_delete');


//route for CrestTask from admin
Route::get('/ShowTask',[UserAuthController::class,'ShowTask'])->name('ShowTask');
Route::post('CreateTask',[UserAuthController::class,'CreateTask'])->name('CreateTask');

//route for show task all title 
Route::get('TaskTitle/{p_id}',[UserAuthController::class,'TaskTitle'])->name('TaskTitle');

//route for delete task and udate task
Route::get('show_task/{task_id}',[UserAuthController::class,'show_task'])->name('show_task');
Route::post('UpdateTask',[UserAuthController::class,'UpdateTask'])->name('UpdateTask');
Route::get('delete_task/{task_id}',[UserAuthController::class,'delete_task'])->name('delete_task');

Route::post('taskstatus',[UserAuthController::class,'taskstatus'])->name('taskstatus');
Route::get('change_status_progress/{task_id}',[UserAuthController::class,'change_status_progress'])->name('change_status_progress');
Route::get('change_status_completed/{task_id}',[UserAuthController::class,'change_status_completed'])->name('change_status_completed');
Route::get('change_status_pending/{task_id}',[UserAuthController::class,'change_status_pending'])->name('change_status_pending');
Route::get('change_status_rejected/{task_id}/{empolyee_id}/{project_id}',[UserAuthController::class,'change_status_rejected'])->name('change_status_rejected');


//route for bank
Route::get('bank',[UserAuthController::class,'bank'])->name('bank');
Route::get('show_bank',[UserAuthController::class,'show_bank'])->name('show_bank');
Route::post('Add_bank',[UserAuthController::class,'Add_bank'])->name('Add_bank');

//route for transiction
Route::get('Show_Transiction_Form',[UserAuthController::class,'Show_Transiction_Form'])->name('Show_Transiction_Form');
Route::post('Add_Transiction',[UserAuthController::class,'Add_Transiction'])->name('Add_Transiction');
//route for balance sheet
Route::get('Balance_Sheet/{bank_id}',[UserAuthController::class,'Balance_Sheet'])->name('Balance_Sheet');
//route for invoice and also storing routes
Route::get('Invoice',[UserAuthController::class,'Invoice'])->name('Invoice');
Route::get('show_Invoice',[UserAuthController::class,'show_Invoice'])->name('show_Invoice');
Route::post('Store_Invoice',[UserAuthController::class,'Store_Invoice'])->name('Store_Invoice');
Route::get('Add_invoice/{id}',[UserAuthController::class,'Add_invoice'])->name('Add_invoice');
Route::get('invoice_print/{id}',[UserAuthController::class,'invoice_print'])->name('invoice_print');
Route::get('Payment/{id}',[UserAuthController::class,'Payment'])->name('payment');
Route::post('addpayment',[UserAuthController::class,'addpayment'])->name('addpayment');





//Routes for Employee
Route::get('empDashboard',[EmployeeController::class,'empDashboard'])->name('empDashboard');
Route::get('assignProject',[EmployeeController::class,'assignProject'])->name('assignProject');

Route::get('createTask',[EmployeeController::class, 'createTask'])->name('createTask');
Route::post('employeeTask',[EmployeeController::class, 'employeeTask'])->name('employeeTask');

Route::get('posttask',[EmployeeController::class, 'posttask'])->name('posttask');
Route::get('addtask',[EmployeeController::class, 'addtask'])->name('addtask');
Route::get('completetask/{id?}',[EmployeeController::class,'completetask'])->name('/completetask');

//Route for userprofile
Route::get('Userprofile',[EmployeeController::class,'Userprofile'])->name('Userprofile');
Route::post('updateprofile',[EmployeeController::class,'updateprofile'])->name('updateprofile');




Route::get('show_tasks/{task_id}',[EmployeeController::class,'show_tasks'])->name('show_tasks');
Route::post('UpdateTasks',[EmployeeController::class,'UpdateTasks'])->name('UpdateTasks');
Route::get('change_status_progres/{task_id}',[EmployeeController::class,'change_status_progres'])->name('change_status_progres');
Route::get('change_status_pause/{task_id}',[EmployeeController::class,'change_status_pause'])->name('change_status_pause');
Route::get('change_status_approval/{task_id}',[EmployeeController::class,'change_status_approval'])->name('change_status_approval');

//route for Notice_Board
Route::get('Notice_Board',[UserAuthController::class,'notice_Board'])->name('Notice_Board');
//route for add_new_notice

Route::post('add_new_notice',[UserAuthController::class,'add_new_notice'])->name('add_new_notice');

//show each empolyee or client notification by id

Route::get('edit_notice/{notifi_id}',[UserAuthController::class,'edit_notice'])->name('edit_notice');
Route::post('update_notice',[UserAuthController::class,'update_notice'])->name('update_notice');
Route::get('delete_notice/{notifi_id}',[UserAuthController::class,'delete_notice'])->name('delete_notice');

//route for fetching notice
Route::get('fetch_notifications',[EmployeeController::class,'fetch_notice'])->name('fetch_notifications');


//route for empolyee shown Notice_Board\
Route::get('show_emp_notice',[EmployeeController::class,'show_emp_notice'])->name('show_emp_notice');
// for time log show
Route::get('report',[ReportController::class,'report'])->name('report');
Route::get('test/{id}',[ReportController::class,'test'])->name('test');
Route::get('time_log/{task_id}',[ReportController::class,'time_log'])->name('time_log');
Route::get('Emp_time_log',[ReportController::class,'Emp_time_log'])->name('Emp_time_log');
//admin approval
Route::get('admin_approval',[ReportController::class,'admin_approval'])->name('admin_approval');
Route::get('change__status_completed/{task_id}',[ReportController::class,'change__status_completed'])->name('change__status_completed');
Route::get('change__status_rejected/{task_id}',[ReportController::class,'change__status_rejected'])->name('change__status_rejected');
//salary route
Route::get('Salary',[ReportController::class,'Salary'])->name('Salary');
Route::get('gen_sal/{id}',[ReportController::class,'gen_sal'])->name('gen_sal');
Route::get('sal_gen/{id}',[ReportController::class,'sal_gen'])->name('sal_gen');
Route::post('sal_save/{id}',[ReportController::class,'sal_save'])->name('sal_save');
Route::get('show_month/{id}',[ReportController::class,'show_month'])->name('show_month');
Route::get('pay_slip/{id}/{date}',[ReportController::class,'pay_slip'])->name('pay_slip');
Route::get('print_pay/{id}/{date}',[ReportController::class,'print_pay'])->name('print_pay');

/*route for today task*/
Route::get('today_task',[ReportController::class,'today_task'])->name('today_task');
Route::get('emp_view/{id}',[ReportController::class,'emp_view'])->name('emp_view');



Route::get('/clear-cache', function() {
Artisan::call('optimize:clear');
echo Artisan::output();
});

Route::get('clear-all-cache', function() {
  
    Artisan::call('route:clear');
    dd("Successfully, you have cleared all cache of application.");
});
  

       















