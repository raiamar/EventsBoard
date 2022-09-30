<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\validator;
use App\Http\Requests\API\UserRequest;
use App\EventBoard\Helper;
use App\Models\User;
use App\Models\VendorRequest;
use App\Http\Requests\API\VendorRequestValidation;
use Auth;

class UserController extends Controller
{

    function __construct(){
        $this->helper = new Helper;
    }


    public function register(Request $request){

        $validator = \Validator::make($request->all(), [
            'name'=> 'required|max:70',
            'email'=>'required|email|unique:users,email',
            'profile'=>'sometimes',
            'password'=> [
            'required', 
            'min:6',       
            ],
            'cpassword' => 'required|same:password',
        ],[
            'name.required'=> 'username is required',
            'name.max'=> 'Username is too long',
            'email.required'=>'Email is required',
            'email.unique'=>'The email has already been taken',
            'email.email'=>'Not a valid email',
            'password.required'=> 'Password is required',
            'password.regex'=> 'Password is must contain at least one lowercase letter, one uppercase, one digit and a special character',
            'password.min'=>'Password must be at least character',
            'cpassword.same' => `Password doesn't match`
        ]);

        if($validator->fails()){
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }
        else{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'profile'=>$this->helper->newImageUpload($request->profile, 'user-profile'),
                'password'=>Hash::make($request->password),
            ]);

            $user->assignRole('user');

            $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'status'=>200,
                'token'=>$token,
                'message'=>'Registration success',
                'data'=> $user,
            ]);
        }
    }


    public function login(Request $request){

        $validator = \Validator::make($request->all(), [
            'password'=> 'required',
        ],[
            'password.required'=>'Correct password is required',
        ]);


        if($validator->fails()){
            if($request->request_from == "form_request"){
                return back()->with('error','Invalid Credentials');
            }else{
                return response()->json([
                    'validation_error'=>$validator->messages(),
                ]); 
            }
        }else{
            $user = User::select("*")->where('email', $request->email )->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {

                return response()->json([
                    'status'=>401,
                    'message'=>'Invalid credential',
                    'error' => [
                        'validation_error' => [
                            'password' => 'Invalid Password',
                        ],
                    ]
                ]);
            }else{
                
                $token = $user->createToken($user->phone.'_Token')->plainTextToken; 
                return response()->json([
                    'status'=>200,
                    'username'=>$user->name,
                    'token'=>$token,
                    'message'=>'Login success',
                    'data'=> $user,
                ]);
            }
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message'=> 'User Logged out',
        ]);
    }

    public function user_detail($id){
        $data = User::find($id);

        $user_details[] = [
            'user_id' => $data->id,
            'name'=>$data->name,
            'email'=>$data->email,
            'profile'=> asset($data->profile),
            'role'=>$data->roles->pluck('name')[0],
        ];
        return response()->json([
            'data'=>$user_details,
        ]);
    }


    public function make_vendor_request(VendorRequestValidation $request, VendorRequest $userRequest)
    {
        $data = $this->helper->getObject($userRequest, $request);
        $data->save();
        return response()->json([
            'message'=>`Request reveived. We'll shortly veryfy four request`,
            'data'=>$data,
        ]);
    }
 
}


