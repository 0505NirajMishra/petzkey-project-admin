<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CustomerAppionmentRequest;

use App\Models\Customerappoinment;

use App\Services\CustomerappoinmentService;

use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerAppoinmentController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/customers';

        //route
        
        $this->index_route_name = 'admin.customers.index';
        $this->create_route_name = 'admin.customers.create';
        $this->detail_route_name = 'admin.customers.show';
        $this->edit_route_name = 'admin.customers.edit';

        //view files

        $this->index_view = 'admin.customerappoinment.index';
        $this->create_view = 'admin.customerappoinment.create';
        $this->edit_view = 'admin.customerappoinment.edit';
       
        //service files 

        $this->customerservice = new CustomerappoinmentService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

    
    public function index(Request $request)
    {
        $items = $this->customerservice->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.customerappoinment.customer_appoinment_table',['customer'=>$items]);
        } else {
            return view('admin.customerappoinment.index',['customer'=>$items]);
        }

    }

    
    public function create()
    {
        return view($this->create_view);
    }

    public function store(CustomerAppionmentRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']); 
        $battle = $this->customerservice->create($input);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'customer appoinemnt', 1)); 
    }

   

    public function show(Customerappoinment $customer)
    {
        return view($this->detail_view,compact('customer'));
    }

   
    public function edit(Customerappoinment $customer)
    {   
        return view($this->edit_view,compact('customer'));
    }


    public function update(CustomerAppionmentRequest $request,Customerappoinment $customer)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->customerservice->update($input,$customer);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('updated', 'customer appoinment', 1));
    }

    public function destroy($id)
    {
     
        $result=DB::table('customerappoinments')->where('cust_appt_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('customer appoinment'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('customer appoinment'),
                'status_name' => 'error'
            ]);
        }

    }

}