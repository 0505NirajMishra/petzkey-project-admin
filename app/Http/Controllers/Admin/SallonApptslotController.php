<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SallonApptslotRequest;

use App\Models\SallonAppslot;

use App\Services\SallonApptslotService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SallonApptslotController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/sallonappslots';

        //route
        
        $this->index_route_name = 'admin.sallonappslots.index';
        $this->create_route_name = 'admin.sallonappslots.create';
        $this->detail_route_name = 'admin.sallonappslots.show';
        $this->edit_route_name = 'admin.sallonappslots.edit';

        //view files

        $this->index_view = 'admin.sallonapptslot.index';
        $this->create_view = 'admin.sallonapptslot.create';
        $this->detail_view = 'admin.sallonapptslot.details';
        $this->tabe_view = 'admin.sallonapptslot.profile';
        $this->edit_view = 'admin.sallonapptslot.edit';
       

        //service files 

        $this->sallonappt = new SallonApptslotService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->sallonappt->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.sallonapptslot.sallon_slot_table',['sallonappt'=>$items]);
        } else {
            return view('admin.sallonapptslot.index',['sallonappt'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(SallonApptslotRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->sallonappt->create($input);

        return redirect()->route($this->index_route_name)->with('success',
        $this->mls->messageLanguage('created', 'sallon appslot', 1)); 
    }

   
    public function show(SallonAppslot $sallonappslot)
    {
        return view($this->detail_view, compact('sallonappslot'));
    }

 

    public function edit(SallonAppslot $sallonappslot)
    {   
        return view($this->edit_view,compact('sallonappslot'));
    }


    public function update(SallonApptslotRequest $request,SallonAppslot $sallonappslot)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->sallonappt->update($input,$sallonappslot);
        
        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('updated', 'sallon apptslot', 1));

    }

   
    public function destroy($id)
    {
        $result=DB::table('sallonaptslots')->where('sallon_apt_slot_id',$id)->delete(); 

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon appslot'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon appslot'),
                'status_name' => 'error'
            ]);
        }

    }

}