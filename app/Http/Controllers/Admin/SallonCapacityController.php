<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SallonCapacityRequest;

use App\Models\SallonCapacity;

use App\Services\SallonCapacityService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SallonCapacityController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/sallonapptcapacitys';

        //route
        
        $this->index_route_name = 'admin.sallonapptcapacitys.index';
        $this->create_route_name = 'admin.sallonapptcapacitys.create';
        $this->detail_route_name = 'admin.sallonapptcapacitys.show';
        $this->edit_route_name = 'admin.sallonapptcapacitys.edit';

        //view files

        $this->index_view = 'admin.salloncapacity.index';
        $this->create_view = 'admin.salloncapacity.create';
        $this->tabe_view = 'admin.salloncapacity.profile';
        $this->edit_view = 'admin.salloncapacity.edit';
       

        //service files 

        $this->salloncapacity = new SallonCapacityService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->salloncapacity->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.salloncapacity.salloncapacity_table',['sallon'=>$items]);
        } else {
            return view('admin.salloncapacity.index',['sallon'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(SallonCapacityRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->salloncapacity->create($input);

        return redirect()->route($this->index_route_name)->with('success',$this->mls->messageLanguage('created', 'sallon appslot', 1)); 
    }

   
    public function show(SallonCapacity $sallonapptcapacity)
    {
        return view($this->detail_view, compact('sallonapptcapacity'));
    }

 

    public function edit(SallonCapacity $sallonapptcapacity)
    {   
        return view($this->edit_view,compact('sallonapptcapacity'));
    }


    public function update(SallonCapacityRequest $request,SallonCapacity $sallonapptcapacity)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->salloncapacity->update($input,$sallonapptcapacity);
        return redirect()->route($this->index_route_name)->with('success',
        $this->mls->messageLanguage('updated', 'sallon capacity', 1));
    }

   
    public function destroy($id)
    {
        $result=DB::table('sallonapptcapacitys')->where('sallon_apt_cap_id',$id)->delete(); 

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon appt capacity'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon appt capacity'),
                'status_name' => 'error'
            ]);
        }

    }

}