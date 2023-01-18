<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\DoctorImageRequest;

use App\Models\Docimages;

use App\Services\DoctorimageService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DoctorImageController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctorimages';

        //route
        
        $this->index_route_name = 'admin.doctorimages.index';
        $this->create_route_name = 'admin.doctorimages.create';
        $this->detail_route_name = 'admin.doctorimages.show';
        $this->edit_route_name = 'admin.doctorimages.edit';

        //view files

        $this->index_view = 'admin.doctorimage.index';
        $this->create_view = 'admin.doctorimage.create';
        $this->detail_view = 'admin.doctorimage.details';
        $this->tabe_view = 'admin.doctorimage.profile';
        $this->edit_view = 'admin.doctorimage.edit';
       
        //service files 

        $this->doctorimage = new DoctorimageService();

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
        $items = $this->doctorimage->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.doctorimage.doctor_image_table',['doctorimage'=>$items]);
        } else {
            return view('admin.doctorimage.index',['doctorimage'=>$items]);
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

    public function store(DoctorImageRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']); 

        $image=$request->file('clinic_img');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/doctor/image/');
        $image->move($destinationPath, $filename);
        $input['clinic_img']=$filename;

        $battle = $this->doctorimage->create($input);
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'doctoravailbilty', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Docimages $doctorimage)
    {
        return view($this->detail_view, compact('doctorimage'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Docimages $doctorimage)
    {   
        return view($this->edit_view,compact('doctorimage'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorImageRequest $request,Docimages $doctorimage)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['clinic_img'])) { 

            $image=$request->file('clinic_img');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/doctor/image/');
            $image->move($destinationPath, $filename);
            $input['clinic_img']=$filename;

            $this->doctorimage->update($input, $doctorimage);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'doctor image', 1));

        } else {

            $this->doctorimage->update($input, $doctorimage);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'doctor image', 1));
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctorclinicimages')->where('clinic_img_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor availbilty'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctor availbilty'),
                'status_name' => 'error'
            ]);
        }

    }

}