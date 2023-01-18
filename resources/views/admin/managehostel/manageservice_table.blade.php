<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">
  <tr>
    <th>ID No.</th>
    <th>Opening Time</th>
    <th>Closing Time</th>
    <th>Pet Type</th>
    <th>Pet Per Hour</th>
    <th>Pet Per Day</th>
    <th>Pet Seat</th>
    <th>Pet Image</th>
    <th>ACTION</th>
  </tr>
  @foreach($manage as $ser)
  <tr>
    <td>{{$ser->pet_id}}</td>
    <td>{{$ser->opening_time}}</td>
    <td>{{$ser->closing_time}}</td>
    <td>{{$ser->pet_type}}</td>
    <td>{{$ser->pet_per_hour}}</td>
    <td>{{$ser->pet_per_day}}</td>
    <td>{{$ser->pet_seat}}</td>
    <td><img src="{{ url('/') }}/managehostelservice/image/{{$ser->pet_image}}" style="width:50px; height:50px;" /></td>

    <td>

    <a href="{{ url('/') }}/admin/managehostels/{{$ser->pet_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-pen"></i>
                  </span>
    </a>
    <a href="{{ url('/') }}/admin/managehostels/destroy/{{$ser->pet_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-trash"></i>
                  </span>
    </a>
    </td>


  </tr>
  @endforeach
</table>