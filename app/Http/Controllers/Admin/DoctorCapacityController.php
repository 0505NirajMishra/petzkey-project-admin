<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\DoctorCapacityRequest;

use App\Models\Doccapacitys;

use App\Services\DoctorcapacityService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DoctorCapacityController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctorcapacitys';

        //route
        
        $this->index_route_name = 'admin.doctorcapacitys.index';
        $this->create_route_name = 'admin.doctorcapacitys.create';
        $this->detail_route_name = 'admin.doctorcapacitys.show';
        $this->edit_route_name = 'admin.doctorcapacitys.edit';

        //view files

        $this->index_view = 'admin.doctorcapacity.index';
        $this->create_view = 'admin.doctorcapacity.create';
        $this->detail_view = 'admin.doctorcapacity.details';
        $this->tabe_view = 'admin.doctorcapacity.profile';
        $this->edit_view = 'admin.doctorcapacity.edit';
       
        //service files 

        $this->capacityservice = new DoctorcapacityService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

    
    public function index(Request $request)
    {
        $items = $this->capacityservice->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.doctorcapacity.doctor_capacity_table',['doctorcapacity'=>$items]);
        } else {
            return view('admin.doctorcapacity.index',['doctorcapacity'=>$items]);
        }

    }

    
    public function create()
    {
        return view($this->create_view);
    }

    public function store(DoctorCapacityRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']); 
        $battle = $this->capacityservice->create($input);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'doctor capacity', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Doccapacitys $doctorcapacity)
    {
        return view($this->detail_view,compact('doctorcapacity'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Doccapacitys $doctorcapacity)
    {   
        return view($this->edit_view,compact('doctorcapacity'));
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorCapacityRequest $request,Doccapacitys $doctorcapacity)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->capacityservice->update($input,$doctorcapacity);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('updated', 'doctor capacity', 1));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctorcapacitys')->where('dr_apt_cap_id', $id)->delete();
     
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