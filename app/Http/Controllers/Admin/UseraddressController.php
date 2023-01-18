<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\UserAddressRequest;

use App\Models\Useraddress;

use App\Services\UseraddressService;

use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UseraddressController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/useradds';

        //route
        
        $this->index_route_name = 'admin.useradds.index';
        $this->create_route_name = 'admin.useradds.create';
        $this->detail_route_name = 'admin.useradds.show';
        $this->edit_route_name = 'admin.useradds.edit';

        //view files

        $this->index_view = 'admin.useraddress.index';
        $this->create_view = 'admin.useraddress.create';
        $this->detail_view = 'admin.useraddress.details';
        $this->tabe_view = 'admin.useraddress.profile';
        $this->edit_view = 'admin.useraddress.edit';
       

        //service files 

        $this->useraddress = new UseraddressService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {   
        $items = $this->useraddress->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.useraddress.useraddress_table',['useraddress'=>$items]);
        } else {
            return view('admin.useraddress.index',['useraddress'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(UserAddressRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $battle = $this->useraddress->create($input);
        
        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('created', 'user address', 1)); 
    }

   
    public function show(Useraddress $useradd)
    {
        return view($this->detail_view, compact('useradd'));
    }

 
    public function edit(Useraddress $useradd)
    {   
        return view($this->edit_view,compact('useradd'));
    }


    public function update(UserAddressRequest $request,Useraddress $useradd)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->useraddress->update($input,$useradd);
        
        return redirect()->route($this->index_route_name)->with('success',
        
        $this->mls->messageLanguage('updated', 'user address', 1));
    }

   
    public function destroy($id)
    {
        $result=DB::table('useraddresss')->where('address_id',$id)->delete(); 

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('user address'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('user address'),
                'status_name' => 'error'
            ]);
        }

    }

}