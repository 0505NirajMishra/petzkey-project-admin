<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>Doctor mrg slot</th>
    <th>Doctor evg slot</th>
    <th>ACTION</th>
  </tr>

  @foreach($doctoraptsolt as $user)
  
  <tr>

    <td>{{$user->dr_apt_slot_td}}</td>
    <td>{{$user->dr_mrg_slot}}</td>
    <td>{{$user->dr_evg_slot}}</td>
    <td>
        <a href="{{ url('/') }}/admin/doctoraptsolts/{{$user->dr_apt_slot_td}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/doctoraptsolts/destroy/{{$user->dr_apt_slot_td}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>