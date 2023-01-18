<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TrainerServiceRequest;

use App\Models\TrainerSer;

use App\Services\TrainerService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TrainerServiceController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/trainerservices';

        //route
        
        $this->index_route_name = 'admin.trainerservices.index';
        $this->create_route_name = 'admin.trainerservices.create';
        $this->detail_route_name = 'admin.trainerservices.show';
        $this->edit_route_name = 'admin.trainerservices.edit';

        //view files

        $this->index_view = 'admin.trainerservice.index';
        $this->create_view = 'admin.trainerservice.create';
        $this->detail_view = 'admin.trainerservice.details';
        $this->tabe_view = 'admin.trainerservice.profile';
        $this->edit_view = 'admin.trainerservice.edit';
       
        //service files 

        $this->trainerser = new TrainerService();

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
        $items = $this->trainerser->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.trainerservice.trainerservicetype_table',['trainerservice'=>$items]);
        } else {
            return view('admin.trainerservice.index',['trainerservice'=>$items]);
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

    public function store(TrainerServiceRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $image=$request->file('trainer_servc_img');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/trainer/image/');
        $image->move($destinationPath, $filename);
        $input['trainer_servc_img']=$filename;

        $battle = $this->trainerser->create($input);

        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'trainer service', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(TrainerSer $trainerservice)
    {
        return view($this->detail_view, compact('trainerservice'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(TrainerSer $trainerservice)
    {   
        return view($this->edit_view,compact('trainerservice'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(TrainerServiceRequest $request,TrainerSer $trainerservice)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $image=$request->file('trainer_servc_img');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/trainer/image/');
        $image->move($destinationPath, $filename);
        $input['trainer_servc_img']=$filename;

        $this->trainerser->update($input,$trainerservice);

        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('updated', 'trainer service', 1));
       
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