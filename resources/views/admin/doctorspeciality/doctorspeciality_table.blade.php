<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>Doctor Specialist Id</th>
    <th>Doctor Specialist Name</th>
    <th>ACTION</th>
  </tr>

  @foreach($doctorspe as $user)
  
  <tr>

    <td>{{$user->dr_spclty_id}}</td>
    <td>{{$user->dr_spclty_name}}</td>
    <td>
        <a href="{{ url('/') }}/admin/docspecialitys/{{$user->dr_spclty_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/docspecialitys/destroy/{{$user->dr_spclty_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>