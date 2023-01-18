<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>Available Days</th>
    <th>Ms Opening Time</th>
    <th>Ms Closing Time</th>
    <th>Es Opening Time</th>
    <th>Es Closing Time</th>
    <th>ACTION</th>
  </tr>

  @foreach($doctors as $user)
  
  <tr>

    <td>{{$user->doctor_avail_id}}</td>
    <td>{{$user->avail_days}}</td>
    <td>{{$user->ms_opening_time}}</td>
    <td>{{$user->ms_closing_time}}</td>
    <td>{{$user->es_opening_time}}</td>
    <td>{{$user->es_closing_time}}</td>
    <td>
        <a href="{{ url('/') }}/admin/doctoravas/{{$user->doctor_avail_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/doctoravas/destroy/{{$user->doctor_avail_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>