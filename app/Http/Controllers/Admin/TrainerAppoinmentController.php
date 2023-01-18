<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TrainerAppionmentRequest;

use App\Models\TrainerAppoinment;

use App\Services\TrainerAppoinmentServices;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TrainerAppoinmentController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/trainerappoinments';

        //route
        
        $this->index_route_name = 'admin.trainerappoinments.index';
        $this->create_route_name = 'admin.trainerappoinments.create';
        $this->detail_route_name = 'admin.trainerappoinments.show';
        $this->edit_route_name = 'admin.trainerappoinments.edit';

        //view files

        $this->index_view = 'admin.trainerappoinment.index';
        $this->create_view = 'admin.trainerappoinment.create';
        $this->detail_view = 'admin.trainerappoinment.details';
        $this->tabe_view = 'admin.trainerappoinment.profile';
        $this->edit_view = 'admin.trainerappoinment.edit';
       

        //service files 

        $this->trainerappoinment = new TrainerAppoinmentServices();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->trainerappoinment->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.trainerappoinment.trainer_appoinment_table',['trainerappoinment'=>$items]);
        } else {
            return view('admin.trainerappoinment.index',['trainerappoinment'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(TrainerAppionmentRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->trainerappoinment->create($input);

        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('created', 'trainer appoinment', 1)); 
    }

   
    public function show(TrainerAppoinment $trainerappoinment)
    {
        return view($this->detail_view, compact('trainerappoinment'));
    }

 
    public function edit(TrainerAppoinment $trainerappoinment)
    {   
        return view($this->edit_view,compact('trainerappoinment'));
    }


    public function update(TrainerAppionmentRequest $request,TrainerAppoinment $trainerappoinment)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->trainerappoinment->update($input,$trainerappoinment);
        
        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('updated', 'trainer appoinment', 1));
    }

   
    public function destroy($id)
    {
        $result=DB::table('trainerappoinments')->where('appt_id',$id)->delete(); 

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer appoinment'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer appoinment'),
                'status_name' => 'error'
            ]);
        }

    }

}