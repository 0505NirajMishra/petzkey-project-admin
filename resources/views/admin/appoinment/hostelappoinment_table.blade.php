<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>appt date time</th>
    <th>book date time</th>
    <th>progress status</th>
    <th>payment</th>
    <th>ACTION</th>
  </tr>

  @foreach($appoinments as $user)
  
  <tr>

    <td>{{$user->appt_id}}</td>
    <td>{{$user->appt_date_time}}</td>
    <td>{{$user->book_date_time}}</td>
    <td>{{$user->progress_status}}</td>
    <td>{{$user->payment}}</td>
    <td>
        <a href="{{ url('/') }}/admin/appoinments/{{$user->appt_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/appoinments/destroy/{{$user->appt_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>