<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TrainerCapacityRequest;

use App\Models\TrainerCapacity;

use App\Services\TrainerCapacityService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TrainerCapacityController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/trainercapacitys';

        //route
        
        $this->index_route_name = 'admin.trainercapacitys.index';
        $this->create_route_name = 'admin.trainercapacitys.create';
        $this->detail_route_name = 'admin.trainercapacitys.show';
        $this->edit_route_name = 'admin.trainercapacitys.edit';

        //view files

        $this->index_view = 'admin.trainercapacity.index';
        $this->create_view = 'admin.trainercapacity.create';
        $this->detail_view = 'admin.trainercapacity.details';
        $this->tabe_view = 'admin.trainercapacity.profile';
        $this->edit_view = 'admin.trainercapacity.edit';
       

        //service files 

        $this->trainercap = new TrainerCapacityService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->trainercap->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.trainercapacity.trainercapacity_table',['trainercapacity'=>$items]);
        } else {
            return view('admin.trainercapacity.index',['trainercapacity'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(TrainerCapacityRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->trainercap->create($input);

        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'trainer capacity', 1)); 
    }

   
    public function show(TrainerCapacity $trainercapacity)
    {
        return view($this->detail_view, compact('trainercapacity'));
    }

 

    public function edit(TrainerCapacity $trainercapacity)
    {   
        return view($this->edit_view,compact('trainercapacity'));
    }


    public function update(TrainerCapacityRequest $request,TrainerCapacity $trainercapacity)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->trainercap->update($input,$trainercapacity);

        return redirect()->route($this->index_route_name)->with('success', 
        
        $this->mls->messageLanguage('updated', 'trainer capacity', 1));
       
    }

   
    public function destroy($id)
    {
        $result=DB::table('trainerapptcapacitys')->where('trainer_apt_cap_id', $id)->delete();     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer capacity'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer capacity'),
                'status_name' => 'error'
            ]);
        }

    }

}