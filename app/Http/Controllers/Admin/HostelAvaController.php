<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\HostelAvaRequest;

use App\Models\hostelavailbilty;

use App\Services\HostelAvailbiltyService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HostelAvaController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/hostelavailbiltys';

        //route
        
        $this->index_route_name = 'admin.hostelavailbiltys.index';
        $this->create_route_name = 'admin.hostelavailbiltys.create';
        $this->detail_route_name = 'admin.hostelavailbiltys.show';
        $this->edit_route_name = 'admin.hostelavailbiltys.edit';

        //view files

        $this->index_view = 'admin.HostelAvailbilty.index';
        $this->create_view = 'admin.HostelAvailbilty.create';
        $this->detail_view = 'admin.HostelAvailbilty.details';
        $this->tabe_view = 'admin.HostelAvailbilty.profile';
        $this->edit_view = 'admin.HostelAvailbilty.edit';
       
        //service files 

        $this->servicehostel = new HostelAvailbiltyService();

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
        $items = $this->servicehostel->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.HostelAvailbilty.hostelava_table',['hostels'=>$items]);
        } else {
            return view('admin.HostelAvailbilty.index',['hostels'=>$items]);
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

    public function store(HostelAvaRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $battle = $this->servicehostel->create($input);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'hostel availbilty', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(hostelavailbilty $hostelavailbilty)
    {
        return view($this->detail_view, compact('hostelavailbilty'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(hostelavailbilty $hostelavailbilty)
    {   
        return view($this->edit_view,compact('hostelavailbilty'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(HostelAvaRequest $request,hostelavailbilty $hostelavailbilty)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->servicehostel->update($input,$hostelavailbilty);

        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'hostel availbilty', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('hostelavailbiltys')->where('hostel_avail_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('hostel availbilty'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('hostel availbilty'),
                'status_name' => 'error'
            ]);
        }

    }

}