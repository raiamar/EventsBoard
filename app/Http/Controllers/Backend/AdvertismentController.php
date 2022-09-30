<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\AdvertismentRequest;
use App\EventBoard\Helper;
use App\Models\Advertisment;

class AdvertismentController extends Controller
{
    private $base_page = 'backend.pages.advertisment.';

    function __construct(){
        $this->helper = new Helper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Advertisment List';
        $breadcrum = 'Advertisment';
        $data = Advertisment::orderBy('created_at', 'DESC')->paginate(10);
        return view($this->base_page . 'list', compact('page', 'breadcrum', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Advertisment List';
        $breadcrum = 'Advertisment | Create Advertisment';
        return view($this->base_page . 'create-advertisment', compact('page', 'breadcrum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertismentRequest $request, Advertisment $add)
    {

        $data = $this->helper->getObject($add, $request);
        if($request->thumbnail):
            $image = $this->helper->newImageUpload($request->thumbnail, 'Advertisment');
            $data['thumbnail'] = $image;
        endif;
        $data->save();
        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Advertisment::find($id);
        $page = 'Edit Advertisment';
        $breadcrum = 'Advertisment | Edit Advertisment';
        return view($this->base_page . 'edit-advertisment', compact('page', 'breadcrum', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertismentRequest $request, $id)
    {
        $add = Advertisment::find($id);
        $old_image = $add->thumbnail;
        $data = $this->helper->getObject($add, $request);
        if($request->thumbnail):
            $remove_old_image = $this->helper->deleteOldImage($old_image);
            $image = $this->helper->newImageUpload($request->thumbnail, 'Advertisment');
            $data['thumbnail'] = $image;
        endif;
        $data->update();
        return to_route('adds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $add = Advertisment::find($id);
        $old_image = $add->thumbnail;
        $remove_old_image = $this->helper->deleteOldImage($old_image);
        $add->delete();
        return to_route('adds.index');
    }
}
