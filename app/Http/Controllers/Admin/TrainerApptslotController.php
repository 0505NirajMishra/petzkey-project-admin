<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TrainerApptslotRequest;

use App\Models\TrainerAppslot;

use App\Services\TrainerApptslotService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TrainerApptslotController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/trainerappslots';

        //route
        
        $this->index_route_name = 'admin.trainerappslots.index';
        $this->create_route_name = 'admin.trainerappslots.create';
        $this->detail_route_name = 'admin.trainerappslots.show';
        $this->edit_route_name = 'admin.trainerappslots.edit';

        //view files

        $this->index_view = 'admin.trainerapptslot.index';
        $this->create_view = 'admin.trainerapptslot.create';
        $this->detail_view = 'admin.trainerapptslot.details';
        $this->tabe_view = 'admin.trainerapptslot.profile';
        $this->edit_view = 'admin.trainerapptslot.edit';
       

        //service files 

        $this->trainerappt = new TrainerApptslotService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->trainerappt->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.trainerapptslot.trainer_slot_table',['traineraap'=>$items]);
        } else {
            return view('admin.trainerapptslot.index',['traineraap'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(TrainerApptslotRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $battle = $this->trainerappt->create($input);

        return redirect()->route($this->index_route_name)->with('success',$this->mls->messageLanguage('created', 'trainer appslot', 1)); 
    }

   
    public function show(TrainerAppslot $trainerappslot)
    {
        return view($this->detail_view, compact('trainerappslot'));
    }

 

    public function edit(TrainerAppslot $trainerappslot)
    {   
        return view($this->edit_view,compact('trainerappslot'));
    }


    public function update(TrainerApptslotRequest $request,TrainerAppslot $trainerappslot)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->trainerappt->update($input,$trainerappslot);
        return redirect()->route($this->index_route_name)->with('success',$this->mls->messageLanguage('updated', 'trainer capacity', 1));

    }

   
    public function destroy($id)
    {
        $result=DB::table('trainerappslots')->where('trainer_apt_slot_id',$id)->delete(); 

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer appslot'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer appslot'),
                'status_name' => 'error'
            ]);
        }

    }

}