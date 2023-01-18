<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">
  
  <tr>
    <th>ID No.</th>
    <th>Category Name</th>
    <th>Fees</th>
    <th>Home</th>
    <th>Desc</th>
    <th>ACTION</th>
  </tr>

  @foreach($clinicdetail as $user)
  
  <tr>

    <td>{{$user->doctor_servc_id}}</td>
    <td>{{$user->pettype}}</td>
    <td>{{$user->clinic_fees}}</td>
    <td>{{$user->home_fees}}</td>
    <td>{{$user->desc}}</td>
    <td>

    <a href="{{ url('/') }}/admin/doctorclinics/{{ $user->doctor_servc_id }}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-pen"></i>
                  </span>
    </a>

    <a href="{{ url('/') }}/admin/doctorclinics/destroy/{{ $user->doctor_servc_id }}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-trash"></i>
                  </span>
    </a>  

    </td>

  </tr>
  @endforeach
</table>

<script>