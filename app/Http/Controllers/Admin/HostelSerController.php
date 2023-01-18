<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\HostelSerRequest;

use App\Models\HostelSer;

use App\Services\HostelSerService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HostelSerController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/hosteladdsers';

        //route
        
        $this->index_route_name = 'admin.hosteladdsers.index';
        $this->create_route_name = 'admin.hosteladdsers.create';
        $this->detail_route_name = 'admin.hosteladdsers.show';
        $this->edit_route_name = 'admin.hosteladdsers.edit';

        //view files

        $this->index_view = 'admin.HostelSer.index';
        $this->create_view = 'admin.HostelSer.create';
        $this->detail_view = 'admin.HostelSer.details';
        $this->tabe_view = 'admin.HostelSer.profile';
        $this->edit_view = 'admin.HostelSer.edit';
       
        //service files 

        $this->hostels = new HostelSerService();

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
        $items = $this->hostels->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.HostelSer.hostelava_table',['hostelservice'=>$items]);
        } else {
            return view('admin.HostelSer.index',['hostelservice'=>$items]);
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

    public function store(HostelSerRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $battle = $this->hostels->create($input);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'hostel service', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(HostelSer $hosteladdser)
    {
        return view($this->detail_view, compact('hosteladdser'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(HostelSer $hosteladdser)
    {   
        return view($this->edit_view,compact('hosteladdser'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(HostelSerRequest $request,HostelSer $hosteladdser)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->hostels->update($input,$hosteladdser);

        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'hostel Service', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('hostelsers')->where('hostel_servc_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('hostel service'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('hostel service'),
                'status_name' => 'error'
            ]);
        }

    }

}