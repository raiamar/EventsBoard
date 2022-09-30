<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\EventRequest;
use Illuminate\Support\Facades\validator;
use App\EventBoard\Helper;
use App\Models\Advertisment;
use App\Models\Event;
use App\Models\ContactUs;
use App\Models\Testemonials;
use App\Models\AboutUs;

class ApisController extends Controller
{

    function __construct(){
        $this->helper = new Helper;
    }


    public function AboutUs(){
        $testemonials = Testemonials::all();
        $about_us = AboutUs::first();

        foreach($testemonials as $data):
            
            $testemonial[] = [
                'name'=>$data->name,
                'designation'=>$data->designation,
                'message'=>$data->message,
                'thumbnail'=>asset($data->thumbnail),
            ];
        endforeach;

        return response()->json([
            'about_us' => $about_us,
            'testemonials'=>$testemonial,
        ]);
    }


    public function ContactReceived(Request $request, ContactUs $contact){
        try{

            $validator = \Validator::make($request->all(), [
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required|numeric|digits:10',
                'message'=>'required|min:5'
            ]);
            if($validator->fails()){
                return response()->json([
                    'validation_error'=>$validator->messages(),
                ]);
            }else{
                $contact = $this->helper->getObject($contact, $request);
                $contact->save();
                return response()->json([
                    'message'=>'Thank you!',
                    'data'=>$contact,
                ]);
            }


        }catch(Exception $e){
            $message = $e->getMessage();
            return response()->json([
                $message,
            ]);
        }
    }


    Public function GetAdvertisment(){
        $adds  = Advertisment::where('status', 1)->get();

        foreach($adds as $item):
            $data [] = [
                'id' => $item->id,
                'thumbnail' => asset($item['thumbnail']),
                'type'=>$item->type,
                'page'=>$item->page,
                'order'=>$item->order,
                'redirect_link'=>$item->redirect_link,
            ];
        endforeach;

    
        return response()->json([
            'info'=> [
                'type'=>[
                    'Slider'=>'0',
                    'Banner'=>'1',
                    'Popup'=>'2'
                ],
                'page'=>[
                    'Home'=>'0',
                    'Navigation'=>'1',
                    'Other'=>'2'
                ],

                'message'=>'ahila lai backend ma size haru handle garako xina so mobile mai yeuta fixed size 
                define gareyara image  lai cover garnu hoi twa',
            ],
            'adds' => $data,
        ]);
    }





   
}
