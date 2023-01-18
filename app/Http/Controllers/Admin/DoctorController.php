<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorRequest;
use App\Models\Doctors;
use App\Services\DoctorService;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService; 


    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctors';

        //route

        $this->index_route_name = 'admin.doctors.index';
        $this->create_route_name = 'admin.doctors.create';
        $this->detail_route_name = 'admin.doctors.show';
        $this->edit_route_name = 'admin.doctors.edit';

        //view files

        $this->index_view = 'admin.doctor.index';
        $this->create_view = 'admin.doctor.create';
        $this->detail_view = 'admin.doctor.details';
        $this->tabe_view = 'admin.doctor.profile';
        $this->edit_view = 'admin.doctor.edit';
       
        //service files

        $this->doctor = new DoctorService();
        
        $this->customerService = new CustomerService(); 

        $this->utilityService = new UtilityService();

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {
        $items = $this->doctor->datatable();

        if ($request->ajax()) 
        {
            return view('admin.doctor.doctor_table',['doctor'=>$items]); 

        } else {
            
            return view('admin.doctor.index',['doctor'=>$items]);
        
        }
    }

 
    public function create()
    {
        return view($this->create_view);
    }

    
    public function store(DoctorRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $image=$request->file('doctor_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/doctor/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['doctor_image']=$filename;
        
        $battle = $this->doctor->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'doctor', 1)); 
    
    }

 
    public function show(Doctors $doctor)
    {
        return view($this->detail_view, compact('doctor'));
    }

    public function edit(Doctors $doctor)
    {
        return view($this->edit_view,compact('doctor'));
    }    

    public function destroy($id)
    {
     
        $result=DB::table('doctors')->where('doctor_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor'),
                'status_name' => 'error'
            ]);
        }
    }

}