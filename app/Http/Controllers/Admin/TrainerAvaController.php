<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TrainerAvaRequest;

use App\Models\traineravailbilty;

use App\Services\TrainerAvailbiltyService;

use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerAvaController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/traineravas';

        //route
        
        $this->index_route_name = 'admin.traineravas.index';
        $this->create_route_name = 'admin.traineravas.create';
        $this->detail_route_name = 'admin.traineravas.show';
        $this->edit_route_name = 'admin.traineravas.edit';

        //view files

        $this->index_view = 'admin.traineravailbilty.index';
        $this->create_view = 'admin.traineravailbilty.create';
        $this->detail_view = 'admin.traineravailbilty.details';
        $this->tabe_view = 'admin.traineravailbilty.profile';
        $this->edit_view = 'admin.traineravailbilty.edit';
       
        //service files 

        $this->trainerava = new TrainerAvailbiltyService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

  
    
    public function index(Request $request)
    {
        $items = $this->trainerava->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.traineravailbilty.trainer_table',['trainer'=>$items]);
        } else {
            return view('admin.traineravailbilty.index',['trainer'=>$items]);
        }
    }

   

    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(TrainerAvaRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $input['avail_days'] = json_encode($input['avail_days']);

        $battle = $this->trainerava->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'tariner availbilty', 1)); 
    }


    public function show(traineravailbilty $trainerava)
    {
        return view($this->detail_view, compact('trainerava'));
    }

   

    public function edit(traineravailbilty $trainerava)
    {   
        return view($this->edit_view,compact('trainerava'));
    }

    
    

    public function update(TrainerAvaRequest $request,traineravailbilty $trainerava)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->trainerava->update($input,$trainerava);

        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('updated', 'trainer availbilty', 1));
       
    }

    public function destroy($id)
    {
     
        $result=DB::table('traineravailbiltys')->where('trainer_avail_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer availbilty'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer availbilty'),
                'status_name' => 'error'
            ]);
        }

    }

}