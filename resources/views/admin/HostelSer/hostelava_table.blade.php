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
    <th>Hour Fees</th>
    <th>Day Fees</th>
    <th>Hostel Seat</th>
    <th>Description</th>
    <th>ACTION</th>
  </tr>

  @foreach($hostelservice as $user)
  
  <tr>

    <td>{{$user->hostel_servc_id}}</td>
    <td>{{$user->pettype}}</td>
    <td>{{$user->hrs_fee}}</td>
    <td>{{$user->day_fee}}</td>
    <td>{{$user->hos_seat}}</td>
    <td>{{$user->desc}}</td>
    <td>
        <a href="{{ url('/') }}/admin/hosteladdsers/{{$user->hostel_servc_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/hosteladdsers/destroy/{{$user->hostel_servc_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>