<html>
        <head>
               <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
               <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        </head>
</html>

<table class="table align-middle table-row-dashed fs-6 gy-5">
  
  <tr>
    <th>Service No</th>
    <th>Company Name</th>
    <th>Company Number</th>
    <th>Company Lic no</th>
    <th>Company Location</th>
    <th>Company Licence Photo</th>
    <th>Company Work photo</th>
    <th>Company Image Logo</th>
    <th>Company Address </th>
    <th>Company Map Location </th>
    <th>Company About us</th>
    <th>ACTION</th>
  </tr>

  @foreach($hostelservice as $user)
  <tr>
    <td>{{$user->cmpny_dtls_id }}</td>
    <td>{{$user->company_name}}</td>
    <td>{{$user->company_lic_no}}</td>
    <td>{{$user->company_location}}</td>
    <td><img src="{{ url('/') }}/hostel/image/{{$user->company_licence_photo}}" style="width:50px; height:50px;" /></td>
    <td><img src="{{ url('/') }}/hostel/image/{{$user->company_work_photo}}" style="width:50px; height:50px;" /></td>
    <td><img src="{{ url('/') }}/hostel/image/{{$user->company_image_logo}}" style="width:50px; height:50px;" /></td>
    <td>{{$user->company_address}}</td>
    <td>{{$user->company_map_location}}</td>
    <td>{{$user->company_aboutus}}</td>
    <td style="display:flex;">

    <a href="{{ url('/') }}/admin/hostelservices/{{$user->cmpny_dtls_id }}/edit" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-pen"></i>
                  </span>
    </a>
    <a href="{{ url('/') }}/admin/hostelservices/destroy/{{$user->cmpny_dtls_id }}" title="Delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" >
                  <span class="svg-icon svg-icon-3">
                      <i class="fa fa-trash"></i>
                  </span>
    </a>  
    </td>
    
   
  </tr>
  @endforeach
</table>