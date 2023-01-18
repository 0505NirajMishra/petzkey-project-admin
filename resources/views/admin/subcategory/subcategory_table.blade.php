<table class="table align-middle table-row-dashed fs-6 gy-5">
  <tr>
    <th>ID No.</th>
    <th>Subcategory Name</th>
    <th>Subcategory Image</th>
    <!-- <th>Category Id</th> -->
    <th>ACTION</th>
  </tr>
  @foreach($subcategorys as $user)
  <tr>
    <td>{{$user->sub_id}}</td>
    <td>{{$user->sub_cat_name}}</td>
    <td> <img src="{{ url('/') }}/subcategory/image/{{$user->sub_cat_image}}" style="width:50px; height:50px;" /></td>
    <!-- <td>{{$user->cat_id}}</td> -->
  <td>

  <a href="{{ url('/') }}/admin/subcategorys/{{$user->sub_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                <span class="svg-icon svg-icon-3">
                    <i class="fa fa-pen"></i>
                </span>
  </a>
  <a href="{{ url('/') }}/admin/subcategorys/destroy/{{$user->sub_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                <span class="svg-icon svg-icon-3">
                    <i class="fa fa-trash"></i>
                </span>
  </a>
  
  </td>
   
  </tr>
  @endforeach
</table>
<div class="row">
<div class="col-lg-12">

         </div>
</div>