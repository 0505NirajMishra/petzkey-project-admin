<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\DoctorAvaRequest;

use App\Models\doctoravailbilty;

use App\Services\DoctorAvailbiltyService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DoctorAvaController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctoravas';

        //route
        
        $this->index_route_name = 'admin.doctoravas.index';
        $this->create_route_name = 'admin.doctoravas.create';
        $this->detail_route_name = 'admin.doctoravas.show';
        $this->edit_route_name = 'admin.doctoravas.edit';

        //view files

        $this->index_view = 'admin.DoctorAvailbilty.index';
        $this->create_view = 'admin.DoctorAvailbilty.create';
        $this->detail_view = 'admin.DoctorAvailbilty.details';
        $this->tabe_view = 'admin.DoctorAvailbilty.profile';
        $this->edit_view = 'admin.DoctorAvailbilty.edit';
       
        //service files 

        $this->servicedoctor = new DoctorAvailbiltyService();

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
        $items = $this->servicedoctor->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.DoctorAvailbilty.doctor_table',['doctors'=>$items]);
        } else {
            return view('admin.DoctorAvailbilty.index',['doctors'=>$items]);
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

    public function store(DoctorAvaRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $input['avail_days'] = json_encode($input['avail_days']);

        $battle = $this->servicedoctor->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'doctoravailbilty', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(doctoravailbilty $doctor)
    {
        return view($this->detail_view, compact('doctor'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(doctoravailbilty $doctorava)
    {   
        return view($this->edit_view,compact('doctorava'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorAvaRequest $request,doctoravailbilty $doctorava)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->servicedoctor->update($input,$doctorava);

        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'doctor', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctoravailbiltys')->where('doctor_avail_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
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