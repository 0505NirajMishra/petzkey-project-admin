<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>Sallon mrg slot</th>
    <th>Sallon evg slot</th>
    <th>ACTION</th>
  </tr>

  @foreach($sallonappt as $user)
  <tr>
    <td>{{$user->sallon_apt_slot_id}}</td>
    <td>{{$user->sallon_mrg_slot}}</td>
    <td>{{$user->sallon_evg_slot}}</td>
    <td>
        <a href="{{ url('/') }}/admin/sallonappslots/{{$user->sallon_apt_slot_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/sallonappslots/destroy/{{$user->sallon_apt_slot_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>
  </tr>
  @endforeach
</table>