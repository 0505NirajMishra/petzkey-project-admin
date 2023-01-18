<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>Clinic Image</th>
    <th>ACTION</th>
  </tr>

  @foreach($doctorimage as $user)
  
  <tr>

    <td>{{$user->clinic_img_id}}</td>
    <td><img src="{{ url('/') }}/doctor/image/{{$user->clinic_img}}" style="width:50px; height:50px;" /></td>
    <td>
        <a href="{{ url('/') }}/admin/doctorimages/{{$user->clinic_img_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/doctorimages/destroy/{{$user->clinic_img_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>