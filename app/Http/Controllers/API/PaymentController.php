<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function EsewaSuccess(Request $request){

        if(isset($request->amt) && isset($request->refId)){
            $record = Booking::where('ticket_code', $request->ticket_code)->first();
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data =[
                'amt'=> $record->total,
                'rid'=> $request->refId,
                'pid'=>$record->ticket_code,
                'scd'=> 'EPAYTEST'
            ];

			    $record->paid = 1;
                $record->payment_method = $request->payment_method;
			    $record->save();
            //    return
        }
    }

    public function esewa_payment_response()
	{
		// return 
	}

    public function EsewaFail(Request $request){
        // return
    }
}
