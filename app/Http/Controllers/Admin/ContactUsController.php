<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactUsRequest;
use App\Models\ContactUs;
use App\Services\ContactUsService;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $contactService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/contactus';
        //route
        $this->index_route_name = 'admin.contactus.index';
        $this->create_route_name = 'admin.contactus.create';
        $this->detail_route_name = 'admin.contactus.show';
        $this->edit_route_name = 'admin.contactus.edit';

        //view files
        $this->index_view = 'admin.contactus.index';
        $this->create_view = 'admin.contactus.create';
        $this->detail_view = 'admin.contactus.details';
        $this->tabe_view = 'admin.contactus.profile';
        $this->edit_view = 'admin.contactus.edit';
       

        //service files
        $this->contactService = new ContactUsService();
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
            $items = $this->contactService->datatable();
            
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
     * @param  ContactUsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        
        $battle = $this->contactService->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'contactus', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactUs  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactu)
    {
        return view($this->detail_view, compact('contactu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $battle
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactu)
    {
        
    
        return view($this->edit_view, compact('contactu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $promocode
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUsRequest $request, ContactUs $contactu)
    {
        
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->contactService->update($input, $contactu);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'contactus', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactu)
    {
        $result = $contactu->delete();
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('contactus'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('contactus'),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        
        $status = ($status == 1) ? 0 : 1;
        $result =  $this->contactService->updateById(['status' => $status], $id);
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
