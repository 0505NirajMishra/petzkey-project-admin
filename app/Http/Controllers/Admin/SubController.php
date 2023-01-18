<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubcategoryRequest;
use App\Models\Subcatgeorys;
use App\Models\Category;
use App\Services\Subcategoryservice;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/subcategorys';

        //route

        $this->index_route_name = 'admin.subcategorys.index';
        $this->create_route_name = 'admin.subcategorys.create';
        $this->detail_route_name = 'admin.subcategorys.show';
        $this->edit_route_name = 'admin.subcategorys.edit';

        //view files

        $this->index_view = 'admin.subcategory.index';
        $this->create_view = 'admin.subcategory.create';
        $this->detail_view = 'admin.subcategory.details';
        $this->tabe_view = 'admin.subcategory.profile';
        $this->edit_view = 'admin.subcategory.edit';
       
        //service files

        $this->subcategoryService = new Subcategoryservice();
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
        $items = $this->subcategoryService->datatable();
        if ($request->ajax()) 
        {
            return view('admin.subcategory.subcategory_table',['subcategorys'=>$items]);
        } else {
            return view('admin.subcategory.index',['subcategorys'=>$items]);
        }

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data['categorys'] = Category::get(["cat_name","cat_id"]);
        return view($this->create_view,$data);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  PromocodeRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(SubcategoryRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $image=$request->file('sub_cat_image');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/subcategory/image/');
        $image->move($destinationPath, $filename);
        $input['sub_cat_image']=$filename;
        $battle = $this->subcategoryService->create($input);
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'subcategory', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Subcatgeorys $subcategory)
    {
        return view($this->detail_view, compact('subcategory'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Subcatgeorys $subcategory)
    {   
        $data['categorys'] = Category::get(["cat_name","cat_id"]);
        return view($this->edit_view,$data,compact('subcategory'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(SubcategoryRequest $request, Subcatgeorys $subcategory)
    {

        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['sub_cat_image'])) 
        { 
            $image=$request->file('sub_cat_image');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/subcategory/image/');
            $image->move($destinationPath, $filename);
            $input['sub_cat_image']=$filename;
            $this->subcategoryService->update($input, $subcategory);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'subcategory', 1));
        } else {
            $this->subcategoryService->update($input, $subcategory);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'subcategory', 1));
        }

    }

     /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result=DB::table('subcategorys')->where('sub_id', $id)->delete();

        return redirect()->back()->withSuccess('Data Delete Successfully!');

        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('subcategory'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('subcategory'),
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