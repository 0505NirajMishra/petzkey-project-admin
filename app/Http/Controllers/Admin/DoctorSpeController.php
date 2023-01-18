<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorSpeRequest;
use App\Models\doctorspeciality;
use App\Services\DoctorSpecialityService;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorSpeController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/docspecialitys';

        //route
        
        $this->index_route_name = 'admin.docspecialitys.index';
        $this->create_route_name = 'admin.docspecialitys.create';
        $this->detail_route_name = 'admin.docspecialitys.show';
        $this->edit_route_name = 'admin.docspecialitys.edit';

        //view files

        $this->index_view = 'admin.doctorspeciality.index';
        $this->create_view = 'admin.doctorspeciality.create';
        $this->detail_view = 'admin.doctorspeciality.details';
        $this->tabe_view = 'admin.doctorspeciality.profile';
        $this->edit_view = 'admin.doctorspeciality.edit';
       
        //service files 

        $this->speservice = new DoctorSpecialityService();

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
        $items = $this->speservice->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.doctorspeciality.doctorspeciality_table',['doctorspe'=>$items]);
        } else {
            return view('admin.doctorspeciality.index',['doctorspe'=>$items]);
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

    public function store(DoctorSpeRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $battle = $this->speservice->create($input);
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'doctor speciality', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(doctorspeciality $docspeciality)
    {
        return view($this->detail_view, compact('docspeciality'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(doctorspeciality $docspeciality)
    {   
        return view($this->edit_view,compact('docspeciality'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorSpeRequest $request,doctorspeciality $docspeciality)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->speservice->update($input,$docspeciality);

        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'doctor speciality', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctorspecialitys')->where('dr_spclty_id',$id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) 
        {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor availbilty'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor availbilty'),
                'status_name' => 'error'
            ]);
        }

    }

}