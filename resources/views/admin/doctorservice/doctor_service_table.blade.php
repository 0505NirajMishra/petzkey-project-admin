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
    <th>Clinic Fee</th>
    <th>Home Fee</th>
    <th>Desc</th>
    <th>ACTION</th>
  </tr>

  @foreach($doctorser as $cap)
  
  <tr>

    <td>{{$cap->doctor_servc_id}}</td>
    <td>{{$cap->pettype}}</td>
    <td>{{$cap->clinic_fee}}</td>
    <td>{{$cap->home_fee}}</td>
    <td>{{$cap->desc}}</td>
    <td>
        <a href="{{ url('/') }}/admin/doctorsers/{{$cap->doctor_servc_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/doctorsers/destroy/{{$cap->doctor_servc_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>