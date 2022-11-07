<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\EventRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Str;
use App\EventBoard\Helper;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Exception;

class EventController extends Controller
{
    function __construct(){
        $this->helper = new Helper;
    }


    public function PreBookings(Request $request){
        try{

            $validator = \Validator::make($request->all(), [
                'details.*.prefix'=>'required',
                'first_name.*.'=>'required',
                'middle_name.*.'=>'required',
                'last_name.*.'=>'required',
                'contact.*.'=>'required|digits:10',
                'email.*.'=>'required|email',
                'total_price'=>'required',
                'event_id'=>'required',
                'organizer_id'=>'required',
                'total_ticket'=>'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'validation_error'=>$validator->messages(),
                ]);
            }else{
                             
                 // do {
                    $ticket_code = random_int(1000, 9999);
                // } while (Booking::where("code", "=", $ticket_code)->first());

                $bookings =  new Booking();
                $bookings->ticket_code = '#EB'.$request['event_id']. '-'.$ticket_code;
                $bookings->event_id = $request['event_id'];
                $bookings->organizer_id = (int)$request['organizer_id'];
                $bookings->total_price = $request['total_price'];
                $bookings->total_ticket = $request['total_ticket'];
                $multi_customer_details = [];
                foreach($request->details as $detail):
                    $customer_detail = [
                        'name' => $detail['prefix']. '.' . $detail['first_name'] . ' '. $detail['middle_name']. $detail['last_name'],
                        'phone' => $detail['contact'],
                        'email'=>$detail['email'],
                    ];
                    array_push($multi_customer_details, $customer_detail);
                endforeach;
                $bookings->customer_details = $multi_customer_details;
                $bookings->save();
                return response()->json([
                    'message' => 'details received now proceed to payment_method',
                    $bookings,
                ]);
            }
            

        }catch(Exception $e){
            $message = $e->getMessage();
            return response()->json([
                'error'=>$message,
            ]);
        }
    }

    public function EventsPreBookingList(){
        $booking  = Event::orderBy('created_at', 'DESC')->where([
            ['pre_booking', 1],
            ['status',1]
            ])->get();
        // $pre_bookings = [];
        foreach($booking as $data):
            $pre_bookings[] = [
                'event_id'=>$data->id,
                'orginizer_id'=>$data->user_id,
                'event'=>$data->title,
                'info'=>$data->info,
                'image'=>asset($data['thumbnail']),
                'qr_code'=>asset($data['qr_code']),
                'start'=>$data->start_date,
                'end'=>$data->end_date,
                'ticket_price'=>$data->ticket_price,
                'address'=>$data->address,
            ];
        endforeach;

        
        return response()->json([
            'data'=>$pre_bookings,
        ]);
    }

    public function GetEvent(){
        $events_list = Event::orderBy('created_at', 'DESC')->get();
            foreach($events_list as $data):

                if($data->category != null){
                    $category = json_decode($data->category);
                }else{
                    $category = 'No Category Yet';
                }
                $events[] = [
                    'event_id'=>$data->id,
                    'event'=>$data->title,
                    'info'=>$data->info,
                    'category'=>$category,
                    'image'=>asset($data['thumbnail']),
                    'qr_code'=>asset($data['qr_code']),
                    'start'=>$data->start_date,
                    'end'=>$data->end_date,
                    'pre_booking'=>$data->form_pre_booking,
                    'ticket_price'=>$data->form_ticket_price,
                    'address'=>$data->form_address,
                    'form_fee'=>$data->form_fee,
                ];
            endforeach;
        return response()->json([
            'data'=>$events,
        ]);
    }

    public function CreateEvent(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'title'=>'required|unique:events,title',
                'info'=>'required',
                'slug'=>'sometimes',
                'thumbnail'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
                'address'=>'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'validation_error'=>$validator->messages(),
                ]);
            }else{

                $data = new Event;
                $data->user_id = Auth::user()->id;
                $data->title = $request->title;
                $data->slug = Str::slug($request->title, '-');
                $data->info = $request->info;
                $data->start_date = $request->start_date;
                $data->end_date = $request->end_date;
                $data->form_fee = $request->form_fee;
                $data->address = $request->address;
                $data->pre_booking = $request->pre_booking;
                $data->ticket_price = $request->ticket_price;

                if($request->thumbnail):
                    $image = $this->helper->newImageUpload($request->thumbnail, 'Events');
                    $data['thumbnail'] = $image;
                endif;


                if($request->qr_code):
                    $image = $this->helper->newImageUpload($request->qr_code, 'Events');
                    $data['qr_code'] = $image;
                endif;

                
                $data->save();
                return response()->json([
                    'data'=>$data,
                ]);
            }

        }catch(Exception $e){
            $message = $e->getMessage();
            return response()->json([
                $message,
            ]);
        }
    }



    public function UpdateEvent(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'title'=>'required',
                'info'=>'required',
                'thumbnail'=>'required',
                'start_date'=>'required',
                'end_date'=>'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'validation_error'=>$validator->messages(),
                ]);
            }else{
                $data = Event::findOrFail($request->event_id);
                $data->user_id = Auth::user()->id;
                $data->title = $request->title;
                $data->slug = Str::slug($request->title, '-');
                $data->info = $request->info;
                $data->start_date = $request->start_date;
                $data->end_date = $request->end_date;
                $old_image = $data->thumbnail;
                $old_qr = $data->qr_code;
                $data->form_fee = $request->form_fee;
                $data->address = $request->address;
                $data->pre_booking = $request->pre_booking;
                $data->ticket_price = $request->ticket_price;

                if($request->thumbnail):
                    if($old_image != null):
                        $this->helper->deleteOldImage($old_image);
                    endif;
                    $image = $this->helper->newImageUpload($request->thumbnail, 'Events');
                    $data['thumbnail'] = $image;
                endif;


                if($request->qr_code):
                    if($old_qr != null):
                        $this->helper->deleteOldqr($old_image);
                    endif;
                    $image = $this->helper->newImageUpload($request->qr_code, 'Events');
                    $data['qr_code'] = $image;
                endif;


                $data->update();
                return response()->json([
                    'data'=>$data,
                ]);
            }

        }catch(Exception $e){
            $message = $e->getMessage();
            return response()->json([
                $message,
            ]);
        }
    }


    public function EditEvent($id){
        $data = Event::findOrFail($id);
        return response()->json([
            'event_id'=>$data->id,
            'data'=>$data,
        ]);
    }
}
