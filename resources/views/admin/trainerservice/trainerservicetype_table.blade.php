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
    <th>Trainer Service Name</th>
    <th>Trainer Service Image</th>
    <th>Trainer Service Package Type</th>
    <th>Trainer Center Fees</th>
    <th>Trainer Home Fees</th>
    <th>ACTION</th>
  </tr>

  @foreach($trainerservice as $user)
  
  <tr>

    <td>{{$user->trainer_servc_id }}</td>
    <td>{{$user->pettype}}</td>
    <td>{{$user->trainer_servc_name}}</td>
    <td> <img src="{{ url('/') }}/trainer/image/{{$user->trainer_servc_img}}"  width="50px;" height="50px;"/></td>
    <td>{{$user->trainer_servc_packagetype}}</td>
    <td>{{$user->cntr_fees}}</td>
    <td>{{$user->home_fees}}</td>
    <td>
        <a href="{{ url('/') }}/admin/trainerservices/{{$user->trainer_servc_id }}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/trainerservices/destroy/{{$user->trainer_servc_id }}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>