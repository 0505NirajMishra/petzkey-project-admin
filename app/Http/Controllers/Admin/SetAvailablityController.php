<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SetAvailabilityRequest;
use App\Models\SetAvailability;
use App\Services\SetAvailabilityService;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UserService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class SetAvailablityController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $battleService, $utilityService, $customerService;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:battle-list|battle-create|battle-edit|battle-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:battle-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:battle-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:battle-delete', ['only' => ['destroy']]);

        //Data
        $this->uploads_image_directory = 'files/battles';
        //route
        $this->index_route_name = 'admin.battles.index';
        $this->create_route_name = 'admin.battles.create';
        $this->detail_route_name = 'admin.battles.show';
        $this->edit_route_name = 'admin.battles.edit';

        //view files
        $this->index_view = 'admin.battle.index';
        $this->create_view = 'admin.battle.create';
        $this->detail_view = 'admin.battle.details';
        $this->tabe_view = 'admin.battle.profile';
        $this->edit_view = 'admin.battle.edit';
        $this->product_history_view = 'admin.battle.product_history';
        $this->change_password = 'admin.admin_profile.change_password';

        //service files
        $this->battleService = new SetAvailabilityService();
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
    public function index(Request $request,$id)
    {
        
        if ($request->ajax()) {
            $items = $this->battleService->datatable($id);
        
            // $items = $this->battleService->search($request, $items);
            return datatables()->eloquent($items)->toJson();
        } else {
            
            return view($this->index_view,['id'=>$id]);
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
    public function store(SetAvailabilityRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $battle = $this->battleService->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'battle', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(SetAvailabilityRequest $battle)
    {
    
        return view($this->detail_view, compact('battle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function edit(SetAvailabilityRequest $battle)
    {
        

        return view($this->edit_view, compact('battle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Battle  $battle
     * @return \Illuminate\Http\Response
     */
    public function update(SetAvailabilityRequest $request, SetAvailability $data)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->battleService->update($input, $data);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'battle', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SetAvailability  $battle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SetAvailability $battle)
    {
        $result = $battle->delete();
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('battle'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('battle'),
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
