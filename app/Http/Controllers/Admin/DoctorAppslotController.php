<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\DoctorAppslotRequest;

use App\Models\DocAppslot;

use App\Services\DoctorappslotService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DoctorAppslotController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/doctoraptsolts';

        //route
        
        $this->index_route_name = 'admin.doctoraptsolts.index';
        $this->create_route_name = 'admin.doctoraptsolts.create';
        $this->detail_route_name = 'admin.doctoraptsolts.show';
        $this->edit_route_name = 'admin.doctoraptsolts.edit';

        //view files

        $this->index_view = 'admin.doctorappsloat.index';
        $this->create_view = 'admin.doctorappsloat.create';
        $this->detail_view = 'admin.doctorappsloat.details';
        $this->tabe_view = 'admin.doctorappsloat.profile';
        $this->edit_view = 'admin.doctorappsloat.edit';
       
        //service files 

        $this->appslotservice = new DoctorappslotService();

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
        $items = $this->appslotservice->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.doctorappsloat.doctor_slot_table',['doctoraptsolt'=>$items]);
        } else {
            return view('admin.doctorappsloat.index',['doctoraptsolt'=>$items]);
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

    public function store(DoctorAppslotRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $battle = $this->appslotservice->create($input);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'doctoraptsolt', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(DocAppslot $doctoraptsolt)
    {
        return view($this->detail_view, compact('doctoraptsolt'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(DocAppslot $doctoraptsolt)
    {   
        return view($this->edit_view,compact('doctoraptsolt'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(DoctorAppslotRequest $request,DocAppslot $doctoraptsolt)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->appslotservice->update($input,$doctoraptsolt);

        return redirect()->route($this->index_route_name)->with('success', 
        
        $this->mls->messageLanguage('updated', 'doctoraptsolt', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('doctoraptslots')->where('dr_apt_slot_td', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctoraptslots'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('doctoraptslots'),
                'status_name' => 'error'
            ]);
        }

    }

}