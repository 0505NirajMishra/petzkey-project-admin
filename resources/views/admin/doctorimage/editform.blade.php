<!--begin::Card body-->
<div class="card-body">
    
    <!--begin::Input group-->
    <div class="row mb-6">        
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.clinic_img_title', 1) }}</label>
        
        <div class="col-lg-4 fv-row">
            
        @if($doctorimage->clinic_img_id)
            <input type="file" class="form-control form-control-lg form-control-solid" name="clinic_img" accept=".png, .jpg, .jpeg">
            <img src="{{ url('/') }}/doctor/image/{{$doctorimage->clinic_img}}" height="50">
        @else
            <input type="file" class="form-control form-control-lg form-control-solid" name="clinic_img" accept=".png, .jpg, .jpeg">
        @endif

        
        </div>

    </div>
 
</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DoctorImageRequest', 'form') !!}
@endpush