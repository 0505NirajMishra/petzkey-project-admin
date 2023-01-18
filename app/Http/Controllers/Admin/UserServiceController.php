<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\UserServiceRequest;

use App\Models\Userservice;

use App\Services\Uservicetype;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserServiceController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/userservices';

        //route
        
        $this->index_route_name = 'admin.userservices.index';
        $this->create_route_name = 'admin.userservices.create';
        $this->detail_route_name = 'admin.userservices.show';
        $this->edit_route_name = 'admin.userservices.edit';

        //view files

        $this->index_view = 'admin.userservicetype.index';
        $this->create_view = 'admin.userservicetype.create';
        $this->detail_view = 'admin.userservicetype.details';
        $this->tabe_view = 'admin.userservicetype.profile';
        $this->edit_view = 'admin.userservicetype.edit';
       
        //service files 

        $this->servicetype = new Uservicetype();

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
        $items = $this->servicetype->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.userservicetype.servicetype_table',['userservice'=>$items]);
        } else {
            return view('admin.userservicetype.index',['userservice'=>$items]);
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

    public function store(UserServiceRequest $request)
    {   
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $battle = $this->servicetype->create($input);
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'servicetype', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Userservice $userservice)
    {
        return view($this->detail_view, compact('userservice'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Userservice $userservice)
    {   
        return view($this->edit_view,compact('userservice'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(UserServiceRequest $request,Userservice $userservice)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->servicetype->update($input,$userservice);

        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('updated', 'servicetype', 1));
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
     
        $result=DB::table('userservices')->where('servicetype_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('servicetype'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('servicetype'),
                'status_name' => 'error'
            ]);
        }

    }

}