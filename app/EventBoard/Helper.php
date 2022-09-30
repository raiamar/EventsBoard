<?php

namespace App\EventBoard;

use App\Enums\Status;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;

class Helper
{
    
    public function getObject($model, $request)
    {
        $data = $request->only($model->getFillable());
        $model->fill($data);
        return $model;
    }


    public function storeMultipleImage($files, $folder)
    {
        try {
            $image = [];
            $time = Carbon::now()->timestamp;
            foreach ($files as $file) {
                $extension = strtolower($file->getClientOriginalName());
                $image_full_name = $time . str_replace(" ", '', $extension);
                $upload_path = 'uploads/' . $folder . '/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                $image[] = $image_url;
            }
            return $image;
        } catch (Exception $e) {
        }
    }
 

    public function newImageUpload($file, $folder){

        if($file == null):
            $filename = '/no_image.jpg';
            return $filename;
        endif;
   
        $time = Carbon::now()->timestamp;
        $extension = $file->getClientOriginalName();
        $filename = $time.'.'. $extension;
        $path = $file->move('uploads/'.$folder, $filename);
        $filename = '/uploads/' . $folder . '/' . $filename;
        return $filename;
    }

    public function deleteOldImage($image)
    {
        unlink(public_path($image));
    }


    public static function svgIcon()
    {

        return [
            'cart' => "M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z",
            'shipping_info'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',

            'delivery_info'=>'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0',
            'payment_info'=>'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',


        ];
    }


}
