<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\Contropanellogin;
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
Route::get('/logout',[LoginController::class,'logout']);
//admin-property controller
Route::get('/admin/dashboard',[LoginController::class,'dashboardcontroller'])->middleware(Contropanellogin::class);
Route::get('/admin/property',[PropertyController::class,'index'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/create-property',[PropertyController::class,'newproperties'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/view-propeties/{id}',[PropertyController::class,'viewproperties'])->middleware(Contropanellogin::class);
Route::post('/property-active',[PropertyController::class,'Active']);
Route::post('/feature-properties',[PropertyController::class,'FeatureActive']);
//admin-leads section
Route::get('/admin/leads',[LeadController::class,'index'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/admin/upload-leads',[LeadController::class,'uploadleads'])->middleware(Contropanellogin::class);
Route::match(['get','post'],'/admin/leads-status',[LeadController::class,'leadsstatus'])->middleware(Contropanellogin::class);
Route::post('/assign-leads',[LeadController::class,'LeadAssign']);
//admin-Employee Controller
Route::match(['get', 'post'],'/admin/create-employee',[EmployeeController::class,'CreateEmployee'])->middleware(Contropanellogin::class);
Route::get('/admin/all-employee',[EmployeeController::class,'ViewEmployee'])->middleware(Contropanellogin::class)->middleware(Controlpanellogin::class);


//Employee-Dashboard Controller
Route::get('/crm-employee/dashboard',[LoginController::class,'employeedashboard'])->middleware(Contropanellogin::class);
Route::get('/crm-employee/assigned-leads',[LeadController::class,'LeadsAssigned'])->middleware(Contropanellogin::class);
Route::match(['get', 'post'],'/crm-employee/status-update-leads/{id}',[LeadController::class,'Leadstatus'])->middleware(Contropanellogin::class);
