<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\DoctorAppoinmentRequest;

use App\Models\doctorappoinments;

use App\Services\DoctorAppoinmentService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DoctorAppoinmentController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctorappoinments';

        //route
        
        $this->index_route_name = 'admin.doctorappoinments.index';
        $this->create_route_name = 'admin.doctorappoinments.create';
        $this->detail_route_name = 'admin.doctorappoinments.show';
        $this->edit_route_name = 'admin.doctorappoinments.edit';

        //view files

        $this->index_view = 'admin.doctorappoinment.index';
        $this->create_view = 'admin.doctorappoinment.create';
        $this->detail_view = 'admin.doctorappoinment.details';
        $this->tabe_view = 'admin.doctorappoinment.profile';
        $this->edit_view = 'admin.doctorappoinment.edit';
       
        //service files 

        $this->docappoinmentservice = new DoctorAppoinmentService();

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
        $items = $this->docappoinmentservice->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.doctorappoinment.doctor_appoinment_table',['doctorappoinment'=>$items]);
        } else {
            return view('admin.doctorappoinment.index',['doctorappoinment'=>$items]);
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

    public function store(DoctorAppoinmentRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
 
        $battle = $this->docappoinmentservice->create($input);
 
        return redirect()->route($this->index_route_name)->with('success', 
 
        $this->mls->messageLanguage('created', 'doctor appoinment', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(doctorappoinments $doctorappoinment)
    {
        return view($this->detail_view, compact('doctorappoinment'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(doctorappoinments $doctorappoinment)
    {   
        return view($this->edit_view,compact('doctorappoinment'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorAppoinmentRequest $request,doctorappoinments $doctorappoinment)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->docappoinmentservice->update($input,$doctorappoinment);

        return redirect()->route($this->index_route_name)->with('success', 
        
        $this->mls->messageLanguage('updated', 'doctor appoinment', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctorappoinments')->where('appt_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor appoinment'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor appoinment'),
                'status_name' => 'error'
            ]);
        }

    }

}