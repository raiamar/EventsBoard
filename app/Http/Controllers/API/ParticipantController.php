<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\EventBoard\Helper;
use App\Models\Participant;
use App\Models\Event;

class ParticipantController extends Controller
{
    function __construct(){
        $this->helper = new Helper;
    }



    public function ReceiveParticipantForm(Request $request){

        try{
            $validator = \Validator::make($request->all(), [
                'event_id'=>'required',
                'name'=>'required',
                'participant_details.*.age'=>'required',
                'email.*.'=>'required',
                'height.*.'=>'required',
                'weight.*.'=>'required',
                'contact.*.'=>'required',
                'p_address.*.'=>'required',
                't_address.*.'=>'required',


                'participant_guardian_details.*.guardian_name'=>'required',
                'guardian_number.*.'=>'required|digits:10',

                'gender'=>'required',
                'pp_image'=>'required',
                'full_image'=>'required',
                'payment_method'=>'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'validation_error'=>$validator->messages(),
                ]);
            }else{


                $orginizer_id = Event::where('id', $request->event_id)->first();

                $participant = new Participant();
                $participant->name = $request->name;
                $participant->orginizer_id = $orginizer_id->user_id;
                $participant->event_id = $request->event_id;
                $participant->category = $request->category;
     
                $participant_details = [
                    'age'=>$request->participant_details[0]['age'],
                    'email'=>$request->participant_details[0]['email'],
                    'height'=>$request->participant_details[0]['height'],
                    'weight'=>$request->participant_details[0]['weight'],
                    'contact'=>$request->participant_details[0]['contact'],
                    'p_address'=>$request->participant_details[0]['p_address'],
                    't_address'=>$request->participant_details[0]['t_address'],
                ];
                $participant->participant_details = $participant_details;
       
                $participant_guardian_details = [
                    'name'=>$request->participant_guardian_details[0]['guardian_name'],
                    'number'=>$request->participant_guardian_details[0]['guardian_number'],
                ];
                $participant->participant_gaurdian  = $participant_guardian_details;
                $participant->gender = $request->gender;

                if($request->pp_image):
                    $image = $this->helper->newImageUpload($request->pp_image, 'Participant');
                    $participant['pp_image'] = $image;
                endif;



                if($request->full_image ):
                    $image = $this->helper->newImageUpload($request->full_image, 'Participant');
                    $participant['full_image'] = $image;
                endif;

                $participant->details = $request->details;
                $participant->payment_method = $request->payment_method;
                $participant->reference = $request->reference;
                $socila_media = [
                    'facebook'=>$request->socila_media[0]['facebook'],
                    'instagram'=>$request->socila_media[0]['instagram'],
                    'tiktok'=>$request->socila_media[0]['tiktok'],
                ];
                $participant->social_media = $socila_media;
                $participant->save();

                return response()->json([
                    'message' => 'details received now proceed to payment_method',
                    $participant,
                ]);


            }
            
        }catch(Exception $e){
            $message = $e->getMessage();
            return response()->json([
                'error'=>$message,
            ]);
        }
    }





    public function VoteCount(Request $request){
        //
    }

    
}
