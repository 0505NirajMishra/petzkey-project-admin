<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TrainerImageRequest;

use App\Models\TrainerImage;

use App\Services\TrainerImageService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TrainerImageController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/trainerimages';

        //route
        
        $this->index_route_name = 'admin.trainerimages.index';
        $this->create_route_name = 'admin.trainerimages.create';
        $this->detail_route_name = 'admin.trainerimages.show';
        $this->edit_route_name = 'admin.trainerimages.edit';

        //view files

        $this->index_view = 'admin.trainerimage.index';
        $this->create_view = 'admin.trainerimage.create';
        $this->detail_view = 'admin.trainerimage.details';
        $this->tabe_view = 'admin.trainerimage.profile';
        $this->edit_view = 'admin.trainerimage.edit';
       
        //service files 

        $this->trainerimage = new TrainerImageService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {
        $items = $this->trainerimage->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.trainerimage.trainerimage_table',['trainer'=>$items]);
        } else {
            return view('admin.trainerimage.index',['trainer'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(TrainerImageRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $image=$request->file('trainer_image');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/trainer/image/');
        $image->move($destinationPath, $filename);
        $input['trainer_image']=$filename;

        $battle = $this->trainerimage->create($input);
        
        return redirect()->route($this->index_route_name)->with('success', 
        $this->mls->messageLanguage('created', 'trainer image', 1)); 
    }

   
    public function show(TrainerImage $trainerimage)
    {
        return view($this->detail_view, compact('trainerimage'));
    }

 

    public function edit(TrainerImage $trainerimage)
    {   
        return view($this->edit_view,compact('trainerimage'));
    }


    public function update(TrainerImageRequest $request,TrainerImage $trainerimage)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $image=$request->file('trainer_image');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/trainer/image/');
        $image->move($destinationPath, $filename);
        $input['trainer_image']=$filename;

        $this->trainerimage->update($input,$trainerimage);

        return redirect()->route($this->index_route_name)->with('success', 
        
        $this->mls->messageLanguage('updated', 'trainer image', 1));
       
    }

   

    public function destroy($id)
    {
     
        $result=DB::table('trainerimages')->where('trainer_img_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer image'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('trainer image'),
                'status_name' => 'error'
            ]);
        }

    }

}