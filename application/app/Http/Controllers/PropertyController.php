<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PropertyController;
use App\Models\amenities;
use App\Models\Properties;
use App\Models\Properties_details;
use App\Models\property_image;
use Image;
class PropertyController extends Controller
{
    public function index(){
        $property=properties::all();
        return view('admin.property.allproperty')->with(compact('property'));
    }
    public function newproperties(Request $req){

        if($req->isMethod('post')){
            $data=$req->all();
            $property_name=$data['pname'];
            $property_id=$data['pid'];
            $property_type=$data['propety_type'];
            $property_desc=$data['desc'];
            $metakeywords=$data['metakeywords'];
            $metadesc=$data['metadesc'];
            $project_location=$data['plocation'];
            $project_city=$data['pcity'];
            $project_state=$data['pstate'];
            $project_pincode=$data['pincode'];
            $project_amenities=implode(",",$data['amenities']);
            //property information
            $size_type=$data['size_type'];
            $property_size=$data['size'];
            $floor_image=$req->file('fimage');
            $property_image=$req->file('pimage');
            //properties database Insert opertation
            $new_property=new Properties;
            $new_property->property_name=$property_name;
            $new_property->property_id=$property_id;
            $new_property->property_type=$property_type;
            $new_property->property_status=$data['propety_status'];
            $new_property->description=$property_desc;
            $new_property->meta_description=$metadesc;
            $new_property->meta_keywords=$metakeywords;
            $new_property->location=$project_location;
            $new_property->city=$project_city;
            $new_property->state=$project_state;
            $new_property->pincode=$project_pincode;
            $new_property->features=$project_amenities;
            $new_property->active= 0;
            $new_property->featured_poperties= 0;
            $new_property->save();
            //Properties Information database Insert opertation

            foreach($data['size_type'] as $key =>$size){
                $property_details=new Properties_details;
                $property_details->pid=$property_id;
                $property_details->property_type=$size;
                $property_details->property_size=$property_size[$key];
                $property_details->map_location=$data['gmap'];
                $property_details->save();
        }
        //floor Images
        foreach($floor_image as $fimage){
            $extension = $fimage->getClientOriginalExtension();
            $fileName = rand(111,99999).'.'.$extension;
            $large_image_path = 'images/property_image/large/'.$fileName;
            $medium_image_path = 'images/property_image/medium/'.$fileName;
            $small_image_path = 'images/property_image/small/'.$fileName;

            Image::make($fimage)->save($large_image_path);
            Image::make($fimage)->resize(255,337)->save($medium_image_path);
            Image::make($fimage)->resize(80,106)->save($small_image_path);
            $image = new property_image;
            $image->floor_image =$fileName;
            $image->pif=$property_id;
            $image->save();
        }
        //Property Image Part
            foreach($property_image as $pimage){

                $extension = $pimage->getClientOriginalExtension();
                $fileName = rand(111,99999).'.'.$extension;
                $large_image_path = 'images/property_image/large/'.$fileName;
                $medium_image_path = 'images/property_image/medium/'.$fileName;
                $small_image_path = 'images/property_image/small/'.$fileName;

                Image::make($pimage)->save($large_image_path);
                Image::make($pimage)->resize(255,337)->save($medium_image_path);
                Image::make($pimage)->resize(80,106)->save($small_image_path);
                $image = new property_image;
                $image->property_image =$fileName;
                $image->pif=$property_id;
                $image->save();
            }
            $amenities=amenities::all();
            return view('admin.property.createproperty')->with(compact('amenities'),'flash_message_success','Propeerty has been added successfullly!');
        }
        $amenities=amenities::all();
        return view('admin.property.createproperty')->with(compact('amenities'));
    }
    //active poperty
    public function Active(Request $request){
        $activated=Properties::where(['id'=>$request->id])->update(['active'=>'1']);
        return response()->json($activated);
    }
    //Feature properties Active
    public function FeatureActive(Request $request){
        $featured=Properties::where(['id'=>$request->id])->update(['featured_poperties'=>'1']);
        return response()->json($featured);
    }
    public function viewproperties(){

        $amenities=amenities::all();
        return view('admin.property.viewproperties')->with(compact('amenities'));
    }
}
