<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\amenities;
use Image;
class AminitiesController extends Controller
{
    public function amminitesdetails(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
            $ammenites=new amenities();
            $ammenites->amminites_name=$data['aname'];
            $ammenites_image=$req->file('aimage');
            $extension = $ammenites_image->getClientOriginalExtension();
            $fileName = rand(1,99999).'.'.$extension;
            $small_image_path = 'images/amminites_image/'.$fileName;
            Image::make($ammenites_image)->resize(80,106)->save($small_image_path);
            $ammenites->Icon_id=$fileName;
            $ammenites->save();
            return redirect('/admin/amminites')->with('flash_message_success','New Amminites Created successfullly!');
        }
        $amenities=amenities::all();
        return view('admin.property.amminites')->with(compact('amenities'));
    }
}
