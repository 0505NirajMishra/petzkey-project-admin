<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\HostelAppoinmentRequest;

use App\Models\HostelAppoinment;

use App\Services\HostelAppoinmentService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AppoinmentController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/appoinments';

        //route
        
        $this->index_route_name = 'admin.appoinments.index';
        $this->create_route_name = 'admin.appoinments.create';
        $this->detail_route_name = 'admin.appoinments.show';
        $this->edit_route_name = 'admin.appoinments.edit';

        //view files

        $this->index_view = 'admin.appoinment.index';
        $this->create_view = 'admin.appoinment.create';
        $this->detail_view = 'admin.appoinment.details';
        $this->tabe_view = 'admin.appoinment.profile';
        $this->edit_view = 'admin.appoinment.edit';
       
        //service files 

        $this->appoinmentser = new HostelAppoinmentService();

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
        $items = $this->appoinmentser->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.appoinment.hostelappoinment_table',['appoinments'=>$items]);
        } else {
            return view('admin.appoinment.index',['appoinments'=>$items]);
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

    public function store(HostelAppoinmentRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $battle = $this->appoinmentser->create($input);
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'appoinment', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(HostelAppoinment $hostelappoinment)
    {
        return view($this->detail_view, compact('hostelappoinment'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(HostelAppoinment $appoinment)
    {   
        return view($this->edit_view,compact('appoinment'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(HostelAppoinmentRequest $request, HostelAppoinment $appoinment)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->appoinmentser->update($input, $appoinment);

        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'appoinment', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('hostelappoinments')->where('appt_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('appoinment'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('appoinment'),
                'status_name' => 'error'
            ]);
        }

    }

    public function status($id, $status)
    {
        
        $status = ($status == 1) ? 0 : 1;
        $result =  $this->categoryService->updateById(['cat_status' => $status], $id);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('updated', 'status', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
                'status_name' => 'error'
            ]);
        }
    }

}