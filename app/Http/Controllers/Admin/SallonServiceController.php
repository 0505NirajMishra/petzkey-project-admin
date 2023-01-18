<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SallonServiceRequest;

use App\Models\SallonSer;

use App\Services\SallonService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SallonServiceController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/sallonservices';

        $this->index_route_name = 'admin.sallonservices.index';
        $this->create_route_name = 'admin.sallonservices.create';
        $this->detail_route_name = 'admin.sallonservices.show';
        $this->edit_route_name = 'admin.sallonservices.edit';

        $this->index_view = 'admin.sallonservice.index';
        $this->create_view = 'admin.sallonservice.create';
        $this->detail_view = 'admin.sallonservice.details';
        $this->tabe_view = 'admin.sallonservice.profile';
        $this->edit_view = 'admin.sallonservice.edit';
       
        $this->sallonser = new SallonService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

     
    
    public function index(Request $request)
    {
        $items = $this->sallonser->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.sallonservice.sallonservicetype_table',['sallonservice'=>$items]);
        } else {
            return view('admin.sallonservice.index',['sallonservice'=>$items]);
        }
    }

  
    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(SallonServiceRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $image=$request->file('sallon_servc_img');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/sallon/image/');
        $image->move($destinationPath, $filename);
        $input['sallon_servc_img']=$filename;

        $battle = $this->sallonser->create($input);

        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'sallon service', 1)); 
    }

  
    public function show(SallonSer $sallonservice)
    {
        return view($this->detail_view, compact('sallonservice'));
    }

  
    public function edit(SallonSer $sallonservice)
    {   
        return view($this->edit_view,compact('sallonservice'));
    }

 

    public function update(SallonServiceRequest $request,SallonSer $sallonservice)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $image=$request->file('sallon_servc_img');
    
        $filename = time().$image->getClientOriginalName();
    
        $destinationPath = public_path('/sallon/image/');
    
        $image->move($destinationPath, $filename);
    
        $input['sallon_servc_img']=$filename;

        $this->sallonser->update($input,$sallonservice);

        return redirect()->route($this->index_route_name)->with('success',$this->mls->messageLanguage('updated', 'sallon service', 1));
       
    }

   
    public function destroy($id)
    {
     
        $result=DB::table('sallonservicess')->where('sallon_servc_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon service'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon service'),
                'status_name' => 'error'
            ]);
        }

    }
}