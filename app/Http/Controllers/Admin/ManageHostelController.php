<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\Hostelmanageservice;
use Illuminate\Http\Request;
use App\Models\Managehostels;
use App\Http\Requests\Admin\ManagehostelserviceRequest;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Support\Facades\DB;


class ManageHostelController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/managehostels';

        //route
        $this->index_route_name = 'admin.managehostels.index';
        $this->create_route_name = 'admin.managehostels.create';
        $this->detail_route_name = 'admin.managehostels.show';
        $this->edit_route_name = 'admin.managehostels.edit';

        //view files
        $this->index_view = 'admin.managehostel.index';
        $this->create_view = 'admin.managehostel.create';
        $this->detail_view = 'admin.managehostel.details';
        $this->tabe_view = 'admin.managehostel.profile';
        $this->edit_view = 'admin.managehostel.edit';
       
        //service files

        $this->hostelService = new Hostelmanageservice();
        
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
        $items = $this->hostelService->datatable();
        if ($request->ajax()) 
        {
            return view('admin.managehostel.manageservice_table',['manage'=>$items]); 

        } else {
            
            return view('admin.managehostel.index',['manage'=>$items]);
        
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

    public function store(ManagehostelserviceRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $image=$request->file('pet_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/managehostelservice/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['pet_image']=$filename;
        
        $battle = $this->hostelService->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'manage', 1)); 
    
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Managehostels $managehostel)
    {
        return view($this->detail_view, compact('managehostel'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Managehostels $managehostel)
    {
        return view($this->edit_view,compact('managehostel'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(ManagehostelserviceRequest $request, Managehostels $managehostel)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        
        if (!empty($input['pet_image'])) { 

            $image=$request->file('pet_image');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/managehostelservice/image/');
            $image->move($destinationPath, $filename);
            $input['pet_image']=$filename;

            $this->hostelService->update($input, $managehostel);

            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'managehostel', 1));

        } else {

            $this->hostelService->update($input, $managehostel);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'managehostel', 1));
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
     
        $result=DB::table('managehostelservice')->where('pet_id', $id)->delete();
     
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