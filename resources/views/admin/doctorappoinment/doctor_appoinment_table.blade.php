<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>Doctor Appoinment Date and Time</th>
    <th>Doctor Book Date and Time</th>
    <th>Doctor Progress Status</th>
    <th>Doctor Payment</th>
    <th>ACTION</th>
  </tr>

  @foreach($doctorappoinment as $aap)
  
  <tr>

    <td>{{$aap->appt_id}}</td>
    <td>{{$aap->appt_date_time}}</td>
    <td>{{$aap->book_date_time}}</td>
    <td>{{$aap->progress_status}}</td>
    <td>{{$aap->payment}}</td>
    <td>
        <a href="{{ url('/') }}/admin/doctorappoinments/{{$aap->appt_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/doctorappoinments/destroy/{{$aap->appt_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>