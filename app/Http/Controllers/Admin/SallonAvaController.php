<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SallonAvaRequest;

use App\Models\sallonavailbilty;

use App\Services\SallonAvailbiltyService;

use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SallonAvaController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/sallonavas';

        //route
        
        $this->index_route_name = 'admin.sallonavas.index';
        $this->create_route_name = 'admin.sallonavas.create';
        $this->detail_route_name = 'admin.sallonavas.show';
        $this->edit_route_name = 'admin.sallonavas.edit';

        //view files

        $this->index_view = 'admin.sallonavailbilty.index';
        $this->create_view = 'admin.sallonavailbilty.create';
        $this->detail_view = 'admin.sallonavailbilty.details';
        $this->tabe_view = 'admin.sallonavailbilty.profile';
        $this->edit_view = 'admin.sallonavailbilty.edit';
       
        //service files 

        $this->sallonava = new SallonAvailbiltyService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

  
    
    public function index(Request $request)
    {
        $items = $this->sallonava->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.sallonavailbilty.trainer_table',['sallon'=>$items]);
        } else {
            return view('admin.sallonavailbilty.index',['sallon'=>$items]);
        }
    }

    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(SallonAvaRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $input['avail_days'] = json_encode($input['avail_days']);

        $battle = $this->sallonava->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'sallon availbilty', 1)); 
    }


    public function show(sallonavailbilty $sallonava)
    {
        return view($this->detail_view, compact('sallonava'));
    }

   

    public function edit(sallonavailbilty $sallonava)
    {   
        return view($this->edit_view,compact('sallonava'));
    }

    
    

    public function update(SallonAvaRequest $request,sallonavailbilty $sallonava)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->sallonava->update($input,$sallonava);

        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('updated', 'sallon availbilty', 1));
       
    }

    public function destroy($id)
    {
     
        $result=DB::table('sallonavailbiltys')->where('sallon_avail_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon availbilty'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon availbilty'),
                'status_name' => 'error'
            ]);
        }

    }

}