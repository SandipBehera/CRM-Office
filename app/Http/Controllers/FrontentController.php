<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;
use App\Models\Properties;
use Image;

class FrontentController extends Controller
{
    public function banners(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
            $banner=new Banners();
            $banner->property_name=$data['property_name'];
            $banner->banner_text=$data['bltext'];
            $banner->banner_text1=$data['bstext'];
            $banner->banner_alt_text=$data['balt'];
            $banner_image=$req->file('bimage');
            $extension = $banner_image->getClientOriginalExtension();
            $fileName = rand(1,99999).'.'.$extension;
            $small_image_path = 'images/banner_image/'.$fileName;
            Image::make($banner_image)->resize(255,337)->save($small_image_path);
            $banner->banner_image=$fileName;
            $banner->save();
            return redirect('/admin/Frontend/banner')->with('flash_message_success','Banner Added Sucessfully');
        }
        $porp=Properties::where('active','!=',0)->get();

        $banner_list=Banners::all();
        return view('admin.pagecontent.banner')->with(compact('porp','banner_list'));

    }
    public function priorbanner(Request $request){

        $get_status=Banners::where(['id'=>$request->id])->get();

        if($get_status->active==0){
            $update_status=Banners::where(['id'=>$get_status->id])->update(['active'=>1]);
        }
        else{
            $update_status=Banners::where(['id'=>$get_status->id])->update(['active'=>0]);
        }
        return response()->json();
    }
}
