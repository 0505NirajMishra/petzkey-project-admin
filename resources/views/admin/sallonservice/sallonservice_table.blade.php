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
    <th>Sallon Service Name</th>
    <th>Sallon Service Image</th>
    <th>Sallon Service Package Type</th>
    <th>Sallon Center Fees</th>
    <th>Sallon Home Fees</th>
    <th>ACTION</th>
  </tr>

  @foreach($sallonservice as $user)
  
  <tr>

    <td>{{$user->sallon_servc_id }}</td>
    <td>{{$user->pettype}}</td>
    <td>{{$user->sallon_servc_name}}</td>
    <td><img src="{{ url('/') }}/sallon/image/{{$user->sallon_servc_img}}"  width="50px;" height="50px;"/></td>
    <td>{{$user->sallon_servc_pckgtyp}}</td>
    <td>{{$user->cntr_fee}}</td>
    <td>{{$user->home_fee}}</td>
    <td>
        <a href="{{ url('/') }}/admin/sallonservices/{{$user->sallon_servc_id }}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-pen"></i>
                    </span>
        </a>
        <a href="{{ url('/') }}/admin/sallonservices/destroy/{{$user->sallon_servc_id }}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                    <span class="svg-icon svg-icon-3">
                        <i class="fa fa-trash"></i>
                    </span>
        </a>  
    </td>

  </tr>
  @endforeach
</table>