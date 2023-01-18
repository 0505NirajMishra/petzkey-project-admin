<html>

        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>

</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">
  <tr>
    <th>ID No.</th>
    <th>Category Name</th>
    <th>Category Image</th>
    <th>Status</th>
    <th>ACTION</th>
  </tr>
  @foreach($categorys as $user)
  <tr>
    <td>{{$user->cat_id}}</td>
    <td>{{$user->cat_name}}</td>
    <td><img src="{{ url('/') }}/category/image/{{$user->cat_image}}" style="width:50px; height:50px;" /></td>
    <td>
              <!--
              @if($user->cat_status == 1)
                <a href="{{ url('/') }}/admin/categorys/status/` + ${cat_id} + `/` + ${cat_status}" class="btn btn-danger">Deactive</a>
              @elseif($user->cat_status == 0)
                <a href="{{ url('/') }}/admin/categorys/status/` + ${cat_id} + `/` + ${cat_status}" class="btn btn-success">Active</a>                   
              @endif 
              -->
              <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" data-id="{{$user->cat_id}}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->cat_status ? 'checked' : '' }}>
              </div>              
    </td>
    <td>

    <a href="{{ url('/') }}/admin/categorys/{{$user->cat_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-pen"></i>
                  </span>
    </a>
    <a href="{{ url('/') }}/admin/categorys/destroy/{{$user->cat_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-trash"></i>
                  </span>
    </a>  
    </td>

   
  </tr>
  @endforeach
</table>

<script>


$(function() { 
           $('.toggle-class').change(function() { 
           var status = $(this).prop('checked') == true ? 1 : 0;  
           var id = $(this).data('cat_id');  
           $.ajax({ 
               type: "GET", 
               dataType: "json", 
               url: `{{ url('/') }}/admin/categorys/status/` + id + `/` + status;,
         }); 
      }) 
   }); 

</script>