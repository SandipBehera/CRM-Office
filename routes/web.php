<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\Contropanellogin;
use App\Http\Controllers\AminitiesController;
use App\Http\Controllers\FrontentController;
use App\Http\Controllers\TaskScheudler;
use Maatwebsite\Excel\Row;

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
//home screen
Route::get('/',[LoginController::class,'login']);
//login controller
Route::match(['get', 'post'],'/login',[LoginController::class,'login']);
Route::match(['get', 'post'],'/login/password-change/{id}',[LoginController::class,'passwordchange']);

Route::get('/logout',[LoginController::class,'logout']);
//admin-property controller
Route::get('/admin/dashboard',[LoginController::class,'dashboardcontroller'])->middleware(Contropanellogin::class);
Route::get('/admin/property',[PropertyController::class,'index'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/create-property',[PropertyController::class,'newproperties'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/edit-property/{id}',[PropertyController::class,'editproperties'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/view-propeties/{id}',[PropertyController::class,'viewproperties'])->middleware(Contropanellogin::class);
Route::post('/prop-delete',[PropertyController::class,'deleteproperty']);
Route::post('/property-active',[PropertyController::class,'Active']);
Route::post('/feature-properties',[PropertyController::class,'FeatureActive']);
Route::match(['get', 'post'], '/admin/amminites', [AminitiesController::class,'amminitesdetails']);
//admin-leads section
Route::get('/admin/leads',[LeadController::class,'index'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/upload-leads',[LeadController::class,'uploadleads'])->middleware(Contropanellogin::class);
Route::match(['get','post'],'/admin/leads-status',[LeadController::class,'leadsstatus'])->middleware(Contropanellogin::class);
Route::match(['get','post'],'/admin/leads-report',[LeadController::class,'leadsreport'])->middleware(Contropanellogin::class);
Route::post('/assign-leads',[LeadController::class,'LeadAssign']);
//admin-Employee Controller
Route::match(['get', 'post'],'/admin/create-employee',[EmployeeController::class,'CreateEmployee'])->middleware(Contropanellogin::class);
Route::get('/admin/all-employee',[EmployeeController::class,'ViewEmployee'])->middleware(Contropanellogin::class);
Route::post('/admin/employee_by_dept',[EmployeeController::class,'employeebydepartment']);

//Employee-Dashboard Controller
Route::get('/crm-employee/dashboard',[LoginController::class,'employeedashboard'])->middleware(Contropanellogin::class);
Route::get('/crm-employee/assigned-leads',[LeadController::class,'LeadsAssigned'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/crm-employee/status-update-leads/{id}',[LeadController::class,'Leadstatus'])->middleware(Contropanellogin::class);
Route::get('/crm-employee/overdue-leads',[LeadController::class,'overduepick'])->middleware(Contropanellogin::class);
Route::post('/overdue-picked-up',[LeadController::class,'overduepicked'])->middleware(Contropanellogin::class);
Route::post('/today-picked-up',[LeadController::class,'todaypicked'])->middleware(Contropanellogin::class);
Route::match(['get','post'],'/crm-employee/today-assign',[LeadController::class,'todayassigned'])->middleware(Contropanellogin::class);
Route::match(['get','post'],'/crm-employee/attendence',[EmployeeController::class,'attendence'])->middleware(Contropanellogin::class);

//Manager Dashboard Lead Controller
Route::get('/crm-manager/dashboard',[LoginController::class,'managerdashboard'])->middleware(Contropanellogin::class);
Route::get('/crm-manager/today-assign',[LeadController::class,'todayemployeeassign'])->middleware(Contropanellogin::class);
Route::get('/crm-manager/follow-up-assign',[LeadController::class,'followupleadsbyemployee'])->middleware(Contropanellogin::class);
Route::get('/crm-manager/employee-lead-status/{status}/{id}',[LeadController::class,'EmployeeLeadStatus'])->middleware(Contropanellogin::class);
//Task Controller
Route::get('/admin/task-data',[TaskScheudler::class,'index'])->middleware(Contropanellogin::class);
//frontend Controller
Route::match(['get', 'post'], '/admin/Frontend/banner',[FrontentController::class,'banners'])->middleware(Contropanellogin::class);
Route::post('/prior',[FrontentController::class,'priorbanner'])->middleware(Contropanellogin::class);
