<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\validator;
use App\Http\Requests\API\UserRequest;
use App\EventBoard\Helper;
use App\Models\User;
use App\Models\VendorRequest;

class UserController extends Controller
{

    private $user_page = "backend.pages.user.";

    function __construct(){
        $this->helper = new Helper;
    }


    public function register_vendor(UserRequest $request){

        try{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'profile'=>$this->helper->newImageUpload($request->profile, 'user-profile'),
                'password'=>Hash::make($request->password),
            ]);
        
            $user->assignRole('vendor');

            toast('Vendor is registered', 'info');
        
            return to_route('get.vendor.list');

        }catch(Exception $e){
            return redirect()->back();
        }
    }



    public function user_list(){
        $page = 'List Of Events Board Users ';
        $breadcrum = 'Manage User | User List';
        $users = User::orderBy('created_at', 'DESC')->paginate(4);
        return view($this->user_page . 'list', compact('breadcrum', 'users', 'page'));
    }


    public function create_vendor(){
        $page = 'Create Vendor';
        $breadcrum = 'Manage User | Create Vendor';
        return view($this->user_page . 'create-vendor', compact('breadcrum', 'page'));
    }


    public function vendor_list(){

        $page = 'List Of Events Board Vendor';
        $breadcrum = 'Manage User | Vendor List';

        $users = User::orderBy('created_at', 'DESC')->role('vendor')->paginate(10);

        return view($this->user_page . 'vendor-list', compact('breadcrum', 'page', 'users'));
    }


    public function VendorRequestList(){
        $page = 'List Of Events Board Orginizer Request';
        $breadcrum = 'Manage User | Vendor Request List';
        $users = VendorRequest::orderBy('created_at', 'DESC')->paginate(20);
        return view($this->user_page . 'vendor-request', compact('breadcrum', 'users', 'page'));
    }

    public function ConfirmVendorRequest($id){

        $data = VendorRequest::where('user_id', $id);

        $user = User::find($id); 
        $role = $user->roles->pluck('name')[0];
        $user->removeRole($role);
        $user->assignRole('vendor');
        $data->delete();
        return back();
    }
    
}
