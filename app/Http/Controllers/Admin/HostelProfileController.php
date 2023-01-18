<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\HostelProfileService;

use Illuminate\Http\Request;

use App\Models\HostelProfile;

use App\Http\Requests\Admin\HostelProfileRequest;

use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Support\Facades\DB;


class HostelProfileController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/hostelprofiles';

        //route
        $this->index_route_name = 'admin.hostelprofiles.index';
        $this->create_route_name = 'admin.hostelprofiles.create';
        $this->detail_route_name = 'admin.hostelprofiles.show';
        $this->edit_route_name = 'admin.hostelprofiles.edit';

        //view files
        $this->index_view = 'admin.hostelprofile.index';
        $this->create_view = 'admin.hostelprofile.create';
        $this->detail_view = 'admin.hostelprofile.details';
        $this->tabe_view = 'admin.hostelprofile.profile';
        $this->edit_view = 'admin.hostelprofile.edit';
       
        //service files

        $this->hostelpro = new HostelProfileService();
        
        $this->customerService = new CustomerService(); 

        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages'); 
        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $items = $this->hostelpro->datatable();

        if ($request->ajax()) 
        {
            return view('admin.hostelprofile.hostelprofiel_table',['profile'=>$items]); 

        } else {
            
            return view('admin.hostelprofile.index',['profile'=>$items]);
        
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view($this->create_view);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  PromocodeRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(HostelProfileRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $image=$request->file('hostel_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/hostelprofile/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['hostel_image']=$filename;
        
        $battle = $this->hostelpro->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'profile', 1)); 
    
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(HostelProfile $hostelprofile)
    {
        return view($this->detail_view, compact('hostelprofile'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(HostelProfile $hostelprofile)
    {
        return view($this->edit_view,compact('hostelprofile'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(HostelProfileRequest $request, HostelProfile $hostelprofile)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        
        if (!empty($input['hostel_image'])) { 

            $image=$request->file('hostel_image');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/hostelprofile/image/');
            $image->move($destinationPath, $filename);
            $input['hostel_image']=$filename;
            $this->hostelpro->update($input, $hostelprofile);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'profile', 1));

        } else {
            $this->hostelpro->update($input, $hostelprofile);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'profile', 1));
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('hostelprofiles')->where('hostle_img_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('profile'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('profile'),
                'status_name' => 'error'
            ]);
        }
    }
}