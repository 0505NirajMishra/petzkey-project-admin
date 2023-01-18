<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\DoctorSerRequest;

use App\Models\doctorservice;

use App\Services\DoctorSer;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DoctorSerController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctorsers';

        //route
        
        $this->index_route_name = 'admin.doctorsers.index';
        $this->create_route_name = 'admin.doctorsers.create';
        $this->detail_route_name = 'admin.doctorsers.show';
        $this->edit_route_name = 'admin.doctorsers.edit';

        //view files

        $this->index_view = 'admin.doctorservice.index';
        $this->create_view = 'admin.doctorservice.create';
        $this->detail_view = 'admin.doctorservice.details';
        $this->tabe_view = 'admin.doctorservice.profile';
        $this->edit_view = 'admin.doctorservice.edit';
       
        //service files 

        $this->docser = new DoctorSer();

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
        $items = $this->docser->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.doctorservice.doctor_service_table',['doctorser'=>$items]);
        } else {
            return view('admin.doctorservice.index',['doctorser'=>$items]);
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

    public function store(DoctorSerRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->docser->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'doctor service', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(doctorservice $doctorser)
    {
        return view($this->detail_view, compact('doctorser'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(doctorservice $doctorser)
    {   
        return view($this->edit_view,compact('doctorser'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorSerRequest $request,doctorservice $doctorser)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->docser->update($input,$doctorser);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('updated', 'doctor service', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctorservices')->where('doctor_servc_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor service'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor service'),
                'status_name' => 'error'
            ]);
        }

    }

}