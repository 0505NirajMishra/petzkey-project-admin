<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\HostelServiceRequest;

use App\Models\Hostelservice;

use App\Services\Hostelservices;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HostelserviceController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/hostelservices';

        //route
        $this->index_route_name = 'admin.hostelservices.index';
        $this->create_route_name = 'admin.hostelservices.create';
        $this->detail_route_name = 'admin.hostelservices.show';
        $this->edit_route_name = 'admin.hostelservices.edit';

        //view files
        $this->index_view = 'admin.hostelservice.index';
        $this->create_view = 'admin.hostelservice.create';
        $this->detail_view = 'admin.hostelservice.details';
        $this->tabe_view = 'admin.hostelservice.profile';
        $this->edit_view = 'admin.hostelservice.edit';
       
        //service files
        $this->hostel = new Hostelservices();
        
        $this->customerService = new CustomerService(); 

        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages'); 
        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $items = $this->hostel->datatable();

        if ($request->ajax()) 
        {
            return view('admin.hostelservice.hostel_table',['hostelservice'=>$items]); 

        } else {
            
            return view('admin.hostelservice.index',['hostelservice'=>$items]);
        
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view($this->create_view);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  PromocodeRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(HostelServiceRequest $request)
    {

        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $image=$request->file('company_licence_photo'); 
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/hostel/image/');
        $image->move($destinationPath, $filename); 
        $input['company_licence_photo']=$filename; 

        $image2=$request->file('company_work_photo'); 
        $filename2 = time().$image2->getClientOriginalName();
        $destinationPath2 = public_path('/hostel/image/');
        $image2->move($destinationPath2, $filename2);
        $input['company_work_photo']=$filename2; 

        $image3=$request->file('company_image_logo');    
        $filename3 = time().$image3->getClientOriginalName();
        $destinationPath3 = public_path('/hostel/image/');
        $image3->move($destinationPath3, $filename3);
        $input['company_image_logo']=$filename3;

        $battle = $this->hostel->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', 
        
        $this->mls->messageLanguage('created', 'add hostel', 1)); 
    
    }

    public function show(Hostelservice $hostelservice)
    {
        return view($this->detail_view, compact('hostelservice'));
    }

    public function edit(Hostelservice $hostelservice)
    {
        return view($this->edit_view,compact('hostelservice'));
    }

    public function update(HostelServiceRequest $request, Hostelservice $hostelservice)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        
        if (!empty($input['company_licence_photo']) || !empty($input['company_work_photo']) || !empty($input['company_image_logo'])) { 

            $image=$request->file('company_licence_photo'); 
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/hostel/image/');
            $image->move($destinationPath, $filename); 
            $input['company_licence_photo']=$filename; 
    
            $image2=$request->file('company_work_photo'); 
            $filename2 = time().$image2->getClientOriginalName();
            $destinationPath2 = public_path('/hostel/image/');
            $image2->move($destinationPath2, $filename2);
            $input['company_work_photo']=$filename2; 
    
            $image3=$request->file('company_image_logo');    
            $filename3 = time().$image3->getClientOriginalName();
            $destinationPath3 = public_path('/hostel/image/');
            $image3->move($destinationPath3, $filename3);
            $input['company_image_logo']=$filename3;

            $this->hostel->update($input,$hostelservice);

            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'update hostel', 1));

        } else {

            $this->hostel->update($input, $hostelservice);

            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'update hostel', 1));
        }
    }

    public function destroy($id)
    {
     
        $result=DB::table('companyservices')->where('cmpny_dtls_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('pets'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('pets'),
                'status_name' => 'error'
            ]);
        }
    }
}