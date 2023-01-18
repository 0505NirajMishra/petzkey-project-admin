<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">

  <tr>
    <th>ID No.</th>
    <th>Trainer mrg slot</th>
    <th>Trainer evg slot</th>
    <th>ACTION</th>
  </tr>

  @foreach($traineraap as $user)
  <tr>
    <td>{{$user->trainer_apt_slot_id}}</td>
    <td>{{$user->trainer_mrg_slot}}</td>
    <td>{{$user->trainer_evg_slot}}</td>
    <td>
        <a href="{{ url('/') }}/admin/trainerappslots/{{$user->trainer_apt_slot_id}}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/trainerappslots/destroy/{{$user->trainer_apt_slot_id}}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>
  </tr>
  @endforeach
</table>