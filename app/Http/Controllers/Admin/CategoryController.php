<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\Categoryservice;
use App\Services\CustomerService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $mls, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $promoService, $utilityService, $customerService;

    public function __construct()
    {
    
        $this->uploads_image_directory = 'files/categorys';

        //route
        
        $this->index_route_name = 'admin.categorys.index';
        $this->create_route_name = 'admin.categorys.create';
        $this->detail_route_name = 'admin.categorys.show';
        $this->edit_route_name = 'admin.categorys.edit';

        //view files

        $this->index_view = 'admin.category.index';
        $this->create_view = 'admin.category.create';
        $this->detail_view = 'admin.category.details';
        $this->tabe_view = 'admin.category.profile';
        $this->edit_view = 'admin.category.edit';
       
        //service files 

        $this->categoryService = new Categoryservice();
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
        $items = $this->categoryService->datatable();
        
        if ($request->ajax()) 
        {
            return view('admin.category.category_table',['categorys'=>$items]);
        } else {
            return view('admin.category.index',['categorys'=>$items]);
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

    public function store(CategoryRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $image=$request->file('cat_image');
        $filename = time().$image->getClientOriginalName();
        $destinationPath = public_path('/category/image/');
        $image->move($destinationPath, $filename);
        $input['cat_image']=$filename;
        $battle = $this->categoryService->create($input);
        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'category', 1)); 
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Category $category)
    {
        return view($this->detail_view, compact('category'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $battle
     * @return \Illuminate\Http\Response
     */

    public function edit(Category $category)
    {
        return view($this->edit_view,compact('category'));
    }

    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */

    public function update(CategoryRequest $request, Category $category)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        // $this->categoryService->update($input, $category);
        // return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'category', 1)); 

        if (!empty($input['cat_image'])) { 

            // $image=$request->file('cat_image');   
            // $picture=FileService::fileUploaderWithoutRequest($image,'/category/image/');
            // $input['cat_image']= $picture; 

            $image=$request->file('cat_image');
            $filename = time().$image->getClientOriginalName();
            $destinationPath = public_path('/category/image/');
            $image->move($destinationPath, $filename);
            $input['cat_image']=$filename;

            $this->categoryService->update($input, $category);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'category', 1));

        } else {

            $this->categoryService->update($input, $category);
            return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('updated', 'category', 1));
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
     
        $result=DB::table('categorys')->where('cat_id', $id)->delete();
     
        return redirect()->back()->withSuccess('Data Delete Successfully!');
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('category'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('category'),
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