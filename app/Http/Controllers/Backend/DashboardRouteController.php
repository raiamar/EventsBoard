<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Requests\TestemonialRequest;
use App\EventBoard\Helper; 
use App\Models\User;
use App\Models\ContactUs;
use App\Models\AboutUs;
use App\Models\Testemonials;

class DashboardRouteController extends Controller
{

    private $user_page = "backend.pages.user.";

    // public function __construct(){
    //     $this->user_page = "backend.pages.user.";
    // }

    function __construct(){
        $this->helper = new Helper;
    }

    public function Dashboard(){
        return view('backend.dashboard');
    }


    // logic for user testimonial
    public function TestimonialList(){
        $page = 'Testimonial';
        $breadcrum  = 'Manage User| Testimonial';
        $testimonials = Testemonials::orderBy('created_at', 'DESC')->where('status', 1)->paginate(20);
        return view('backend.pages.testimonial.list', compact('page', 'breadcrum', 'testimonials'));
    }

    public function CreateTestimonial(){
        $page = 'Testimonial';
        $breadcrum  = 'Manage User| Testimonial | Create';
        return view('backend.pages.testimonial.create', compact('page', 'breadcrum'));
    }

    

    public function EditTestimonal($id){
        $data = Testemonials::findOrFail($id);
        $page = 'Testimonial';
        $breadcrum  = 'Manage User| Testimonial | Edit';
        return view('backend.pages.testimonial.edit', compact('page', 'breadcrum', 'data'));
    }

    public function ManageTestimonal(TestemonialRequest $request){
        if($request->testemonial_id){
            $testimonial = Testemonials::find($request->testemonial_id);
            $old_image = $testimonial->thumbnail;
            if($request->thumbnail){
                $this->helper->deleteOldImage($old_image);
                $thumbnail = $this->helper->newImageUpload($request->thumbnail, 'Testemonials');
            }else{
                $thumbnail = $old_image;
            }
        }else{
            if($request->thumbnail):
                $thumbnail = $this->helper->newImageUpload($request->thumbnail, 'Testemonials');
            endif;
        }
        $testimonials = Testemonials::updateOrCreate(
            ['id'=> $request->testemonial_id],
            [
                'name'=> $request->name,
                'designation'=>$request->designation,
                'message'=>$request->message,
                'thumbnail'=> $thumbnail,
            ]
            );
            toast('Action success', 'info');
            return to_route('testimonial');
    }


    // logic for about us
    public function AboutUs(){
        $data = AboutUs::first();
        $page = 'About Us';
        $breadcrum = 'About Us';
        return view('backend.pages.about-us', compact('page', 'breadcrum', 'data'));
    }


    public function ManageAboutUs(Request $request){
        $aboutUs = AboutUs::updateOrCreate(
            ['id'=>1],
            [ 'about_us' => $request->about_us ],
        );
        return back();
    }



    // logic for contact us
    public function ContactList(){
        $page = 'Contact List';
        $breadcrum = 'Contact-us';
        $data = ContactUs::orderBy('created_at', 'DESC')->paginate(20);
        return view('backend.pages.contact_us', compact('page', 'breadcrum', 'data'));
    }


    public function MarkAaRead($id){
        $data = ContactUs::findOrFail($id);
        $data->status = 1;
        $data->update();
        return back();
    }
  
}
