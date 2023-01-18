<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SallonAppionmentRequest;

use App\Models\SallonAppoinment;

use App\Services\SallonAppoinmentServices;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SallonAppoinmentController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/sallonappionments';

        //route
        
        $this->index_route_name = 'admin.sallonappionments.index';
        $this->create_route_name = 'admin.sallonappionments.create';
        $this->detail_route_name = 'admin.sallonappionments.show';
        $this->edit_route_name = 'admin.sallonappionments.edit';

        //view files

        $this->index_view = 'admin.sallonappoinment.index';
        $this->create_view = 'admin.sallonappoinment.create';
        $this->edit_view = 'admin.sallonappoinment.edit';
       

        //service files 

        $this->sallonappoinment = new SallonAppoinmentServices();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->sallonappoinment->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.sallonappoinment.sallon_appoinment_table',['sallonappoinment'=>$items]);
        } else {
            return view('admin.sallonappoinment.index',['sallonappoinment'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(SallonAppionmentRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->sallonappoinment->create($input);

        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('created', 'trainer appoinment', 1)); 
    }

   
    public function show(SallonAppoinment $sallonappionment)
    {
        return view($this->detail_view,compact('sallonappionment'));
    }

 
    public function edit(SallonAppoinment $sallonappionment)
    {   
        return view($this->edit_view,compact('sallonappionment'));
    }


    public function update(SallonAppionmentRequest $request,SallonAppoinment $sallonappionment)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->sallonappoinment->update($input,$sallonappionment);
        
        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('updated', 'sallon appoinment', 1));
    }

   
    public function destroy($id)
    {
        $result=DB::table('sallonappoinments')->where('appt_id',$id)->delete(); 

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon appoinment'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon appoinment'),
                'status_name' => 'error'
            ]);
        }

    }

}