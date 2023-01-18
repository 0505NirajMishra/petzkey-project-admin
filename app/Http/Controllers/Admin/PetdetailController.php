<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PetDetailRequest;

use App\Models\Petdetails;
use App\Services\PetDetailsService;
use App\Services\CustomerService;

use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetdetailController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/petdetails';

        //route
        $this->index_route_name = 'admin.petdetails.index';
        $this->create_route_name = 'admin.petdetails.create';
        $this->detail_route_name = 'admin.petdetails.show';
        $this->edit_route_name = 'admin.petdetails.edit';

        //view files
        $this->index_view = 'admin.petdetail.index';
        $this->create_view = 'admin.petdetail.create';
        $this->detail_view = 'admin.petdetail.details';
        $this->tabe_view = 'admin.petdetail.profile';
        $this->edit_view = 'admin.petdetail.edit';
       
        //service files
        $this->petdetailService = new PetDetailsService();
        
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
        $items = $this->petdetailService->datatable();
        
        if ($request->ajax()) 
        {
            return view('admin.petdetail.petdetails_table',['pets'=>$items]); 

        } else {
            
            return view('admin.petdetail.index',['pets'=>$items]);
        
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

    public function store(PetDetailRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $image=$request->file('pet_image');
        
        $filename = time().$image->getClientOriginalName();
        
        $destinationPath = public_path('/petdetail/image/');
        
        $image->move($destinationPath, $filename);
        
        $input['pet_image']=$filename;
        
        $battle = $this->petdetailService->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'petdetail', 1)); 
    
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Petdetails $petdetail)
    {
        return view($this->detail_view, compact('pets'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Petdetails $petdetail)
    {
        return view($this->edit_view,compact('petdetail'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(PetDetailRequest $request, Petdetails $petdetail)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        
        if (!empty($input['pet_image'])) { 

            $image=$request->file('pet_image');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/petdetail/image/');
            $image->move($destinationPath, $filename);
            $input['pet_image']=$filename;

            $this->petdetailService->update($input, $petdetail);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'pets', 1));

        } else {

            $this->petdetailService->update($input, $petdetail);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'pets', 1));
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
     
        $result=DB::table('petdetails')->where('pet_id', $id)->delete();
     
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