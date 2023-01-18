<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">
  <tr>
    <th>ID No.</th>
    <th>Pet Type</th>
    <th>Pet Breed</th>
    <th>Pet Gender</th>
    <th>Pet Height</th>
    <th>Pet Year</th>
    <th>Pet Month</th>
    <th>Pet Weight</th>
    <th>Pet Image</th>
    <th>ACTION</th>
  </tr>

  @foreach($pets as $pet)
  
  <tr>
    <td>{{$pet->pet_id}}</td>
    <td>{{$pet->pet_type}}</td>
    <td>{{$pet->pet_breed}}</td>
    <td>{{$pet->pet_gender}}</td>
    <td>{{$pet->pet_height}}</td>
    <td>{{$pet->pet_year}}</td>
    <td>{{$pet->pet_month}}</td>
    <td>{{$pet->pet_weight}}</td>
    <td><img src="{{ url('/') }}/petdetail/image/{{$pet->pet_image}}" style="width:50px; height:50px;" /></td>
    <td>

    <a href="{{ url('/') }}/admin/petdetails/{{$pet->pet_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-pen"></i>
                  </span>
    </a>
    <a href="{{ url('/') }}/admin/petdetails/destroy/{{$pet->pet_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
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