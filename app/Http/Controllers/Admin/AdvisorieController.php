<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SetAvailablityController;
use App\Http\Requests\Admin\AdvisorieRequest;
use App\Models\Advisorie;
use App\Services\AdvisorieService;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class AdvisorieController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $battleService, $utilityService, $customerService;

    public function __construct()
    {
       
        //Data
        $this->uploads_image_directory = 'files/advisorys';
        
        //route
        $this->index_route_name = 'admin.advisorys.index';
        $this->create_route_name = 'admin.advisorys.create';
        $this->detail_route_name = 'admin.advisorys.show';
        $this->edit_route_name = 'admin.advisorys.edit';

        //view files
        $this->index_view = 'admin.advisory.index';
        $this->create_view = 'admin.advisory.create';
        $this->detail_view = 'admin.advisory.details';
        $this->tabe_view = 'admin.advisory.profile';
        $this->edit_view = 'admin.advisory.edit';
        $this->product_history_view = 'admin.advisory.product_history';
        $this->change_password = 'admin.admin_profile.change_password';

        //service files
        $this->battleService = new AdvisorieService();
        // $this->customerService = new CustomerService();
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
        if ($request->ajax()) {
            $items = $this->battleService->datatable();
            // $items = $this->battleService->search($request, $items);
            return datatables()->eloquent($items)->toJson();
        } else {
            return view($this->index_view);
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
     * @param  BattleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvisorieRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $logo=$request->file('icon');

        $filename = time().$logo->getClientOriginalName();
        $destinationPath = public_path('/advisorie/image/');

        $logo->move($destinationPath, $filename);
        $input['icon']=$filename;
       
        $advisory = $this->battleService->create($input);
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'advisory', 1));
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvisorieRequest  $battle
     * @return \Illuminate\Http\Response
     */
    
    public function show(AdvisorieRequest $advisory)
    {
        return view($this->detail_view, compact('advisory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advisorie  $battle
     * @return \Illuminate\Http\Response
     */
    public function edit(Advisorie $advisory)
    {
        return view($this->edit_view, compact('advisory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function update(AdvisorieRequest $request, Advisorie $advisory)
    {
      
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
       
        // if($request->file!=null){
        // $logo=$request->file('icon');
   
        // $filename = time().$logo->getClientOriginalName();
        
        // $destinationPath = public_path('/advisorie/image/');

        // $logo->move($destinationPath, $filename);
        // $input['icon']=$filename;
// 

if (!empty($input['icon'])) {
    $logo=$request->file('icon');
   
    $filename = time().$logo->getClientOriginalName();
    
    $destinationPath = public_path('/advisorie/image/');

    //  Azure File Storage  //

    // $destinationPath = $logo->storeAs('uploads/', $filename, 'azure');

    $logo->move($destinationPath, $filename);
    $input['icon']=$filename;
    
    $this->battleService->update($input, $advisory);
    return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'advisory', 1));
} else {
    $this->battleService->update($input, $advisory);
    return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'advisory', 1));
}


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advisorie  $battle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advisorie $advisory)
    {
        $result = $advisory->delete();
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('advisory'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('advisory'),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        
        $status = ($status == 1) ? 0 : 1;
        $result =  $this->battleService->updateById(['is_active' => $status], $id);
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
