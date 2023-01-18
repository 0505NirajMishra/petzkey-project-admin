<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromocodeRequest;
use App\Models\Promocode;
use App\Services\PromocodeService;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/promocodes';
        //route
        $this->index_route_name = 'admin.promocodes.index';
        $this->create_route_name = 'admin.promocodes.create';
        $this->detail_route_name = 'admin.promocodes.show';
        $this->edit_route_name = 'admin.promocodes.edit';

        //view files
        $this->index_view = 'admin.promocode.index';
        $this->create_view = 'admin.promocode.create';
        $this->detail_view = 'admin.bapromocodettle.details';
        $this->tabe_view = 'admin.promocode.profile';
        $this->edit_view = 'admin.promocode.edit';
       

        //service files
        $this->promoService = new PromocodeService();
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
        if ($request->ajax()) {
            $items = $this->promoService->datatable();
            
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
     * @param  PromocodeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromocodeRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $battle = $this->promoService->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'promocode', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Promocode $promocode)
    {
        return view($this->detail_view, compact('promocode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */
    public function edit(Promocode $promocode)
    {
        

        return view($this->edit_view, compact('promocode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function update(PromocodeRequest $request, Promocode $promocode)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->promoService->update($input, $promocode);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'promocode', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocode $promocode)
    {
        $result = $promocode->delete();
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('promocode'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('promocode'),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        
        $status = ($status == 1) ? 0 : 1;
        $result =  $this->promoService->updateById(['status' => $status], $id);
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
