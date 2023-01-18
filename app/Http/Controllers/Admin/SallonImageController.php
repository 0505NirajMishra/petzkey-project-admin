<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SallonImageRequest;

use App\Models\SallonImage;

use App\Services\SallonImageService;

use App\Services\CustomerService;

use App\Services\ManagerLanguageService;

use App\Services\UtilityService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SallonImageController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/sallons';

        //route
        
        $this->index_route_name = 'admin.sallons.index';
        $this->create_route_name = 'admin.sallons.create';
        $this->detail_route_name = 'admin.sallons.show';
        $this->edit_route_name = 'admin.sallons.edit';

        //view files

        $this->index_view = 'admin.sallonimage.index';
        $this->create_view = 'admin.sallonimage.create';
        $this->detail_view = 'admin.sallonimage.details';
        $this->tabe_view = 'admin.sallonimage.profile';
        $this->edit_view = 'admin.sallonimage.edit';
       
        //service files 

        $this->sallonservice = new SallonImageService();

        $this->customerService = new CustomerService();
        
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php 

        $this->mls = new ManagerLanguageService('messages'); 
        
    }

   
    public function index(Request $request)
    {
        $items = $this->sallonservice->datatable();
        
        if($request->ajax()) 
        {
            return view('admin.sallonimage.sallonimage_table',['sallon'=>$items]);
        } else {
            return view('admin.sallonimage.index',['sallon'=>$items]);
        }
    }


    public function create()
    {
        return view($this->create_view);
    }

   
    public function store(SallonImageRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $image=$request->file('sallon_img');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/sallon/image/');
        $image->move($destinationPath, $filename);
        $input['sallon_img']=$filename;

        $battle = $this->sallonservice->create($input);
        
        return redirect()->route($this->index_route_name)->with('success',$this->mls->messageLanguage('created', 'trainer image', 1)); 
    }

   
    public function show(SallonImage $sallon)
    {
        return view($this->detail_view, compact('sallon'));
    }

 

    public function edit(SallonImage $sallon)
    {   
        return view($this->edit_view,compact('sallon'));
    }


    public function update(SallonImageRequest $request,SallonImage $sallon)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $image=$request->file('sallon_img');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/sallon/image/');
        $image->move($destinationPath, $filename);
        $input['sallon_img']=$filename;

        $this->sallonservice->update($input,$sallon);

        return redirect()->route($this->index_route_name)->with('success', 
        
        $this->mls->messageLanguage('updated', 'trainer image', 1));
       
    }

   

    public function destroy($id)
    {
     
        $result=DB::table('sallonimages')->where('sallon_img_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon image'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('sallon image'),
                'status_name' => 'error'
            ]);
        }

    }

}