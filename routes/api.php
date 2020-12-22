<?php

use App\Models\WebsiteQuries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('website_quires',function(Request $req){
$quires=new WebsiteQuries;
$quires->client_name=$req->name;
$quires->email=$req->email;
$quires->phone=$req->phone;
$quires->message=$req->message;
$quires->query_from=$req->url;
$quires->save();
return response()->json([
    "message"=>"Data Inserted Sucessfully"
],201);
});
