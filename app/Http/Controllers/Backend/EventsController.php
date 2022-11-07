<?php

namespace App\Http\Controllers\Backend;

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
use App\Models\Category;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Exception;

class EventsController extends Controller
{
    
    private $page = 'backend.pages.events.';
    private $parti = 'backend.pages.participants.';

    function __construct(){
        $this->helper = new Helper;
    }

    public function has_many(){
        // $evetn=Event::with("child_category")->first();
    }
    



    /******************************Participants************************************/
    public function EventsDetails(){
        $data = Event::where([
            ['user_id', Auth::user()->id],
            ['status', 1]
            ])->get();
        return view($this->parti.'event_list', compact('data'));    
    }

    public function ParticipantDetails($id){

        $page = 'Participant List';
        $breadcrum  = 'Manage Event| Participants';
        $event_name = Event::where('id',$id)->first();
        $data = Participant::where([
            ['event_id',$id],
            ['orginizer_id', Auth::user()->id]
        ])->paginate(20);
        return view($this->parti.'participants_list', compact('data', 'page', 'event_name', 'breadcrum')); 
    }

    public function EventList(){
        $page = 'Event List';
        $breadcrum  = 'Manage Event| Event';
        $event_list = Event::orderBy('created_at', 'DESC')->where([
            ['status', 1],
            ['user_id', Auth::user()->id]
        ])->paginate(20);
        return view($this->page.'list', compact('page', 'breadcrum', 'event_list'));
    }

    public function CreateEvent()
    {
        $page = 'Create Event';
        $breadcrum  = 'Manage Event| Create';
        $category = Category::orderBy('created_at', 'DESC')->where([
            ['status', 1],
            ['orginizer_id', Auth::user()->id]
            ])->get();
        return view($this->page.'create', compact('page', 'breadcrum', 'category'));
    }

    // EventRequest

    public function ManageEvent(Request $request)
    {

        try{
            
            $valid_from = Carbon::parse($request->start_date);
            $valid_till = Carbon::parse($request->end_date);



            // if($request->testemonial_id){
            //     $testimonial = Testemonials::find($request->testemonial_id);
            //     $old_image = $testimonial->thumbnail;
            //     if($request->thumbnail){
            //         $this->helper->deleteOldImage($old_image);
            //         $thumbnail = $this->helper->newImageUpload($request->thumbnail, 'Testemonials');
            //     }else{
            //         $thumbnail = $old_image;
            //     }
            // }else{
            //     if($request->thumbnail):
            //         $thumbnail = $this->helper->newImageUpload($request->thumbnail, 'Testemonials');
            //     endif;
            // }

            if($request->thumbnail):
                $thumbnail = $this->helper->newImageUpload($request->thumbnail, 'Test-Event');
            endif;


            if($request->qr_code):
                $qr_code = $this->helper->newImageUpload($request->qr_code, 'Test-Event');
            endif;

            // dd($request->all());

            $event = Event::updateOrCreate(
                ['id'=>$request->event_id],
                [
                    'user_id'=>Auth::user()->id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title, '-'),
                    'info' => $request->info,
                    'thumbnail'=> $thumbnail,
                    'qr_code'=> $qr_code,
                    'address'=> $request->address,
                    'form_fee'=>$request->form_fee,
                    'ticket_price'=>$request->ticket_price,
                    'pre_booking'=>$request->pre_booking,
                    'category'=>json_encode($request->category),
                    'start_date'=>$valid_from,
                    'end_date'=>$valid_till,
                ]
            );

           return to_route('event');

        }catch(Exception $e){
            return $message = $e->getMessage();
        }

    }


    public function EditEvent($id){
        $data = Event::findOrFail($id);
        $page = 'Edit Event';
        $breadcrum  = 'Manage Event| Edit';
        $category = Category::orderBy('created_at', 'DESC')->where([
            ['status', 1],
            ['orginizer_id', Auth::user()->id]
            ])->get();
        return view($this->page.'edit', compact('page', 'breadcrum', 'category', 'data'));
    }

}
