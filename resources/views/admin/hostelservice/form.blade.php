<!--begin::Card body-->
<div class="card-body">

    <div class="row mb-6">

        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_name_title', 1) }}</label>
        <div class="col-lg-3 fv-row">
            {!! Form::text('company_name', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.company_name', 1)]) !!}
        </div> 

        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_lic_no_title', 1) }}</label>
        <div class="col-lg-3 fv-row">
            {!! Form::text('company_lic_no', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.company_lic_no', 1)]) !!}
        </div> 

    </div>

    <div class="row mb-6">

        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_work_photo_title', 1) }}</label>

        <div class="col-lg-3 fv-row">
                <input type="file" class="form-control form-control-lg form-control-solid" name="company_work_photo" accept=".png, .jpg, .jpeg">
        </div>

        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_licence_photo_title', 1) }}</label>

        <div class="col-lg-3 fv-row">
                <input type="file" class="form-control form-control-lg form-control-solid" name="company_licence_photo" accept=".png, .jpg, .jpeg">
        </div> 

    </div>

    <div class="row mb-6">

        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_location_title', 1) }}</label>
        
        <div class="col-lg-3 fv-row">
            {!! Form::text('company_location', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.company_location', 1)]) !!}
        </div> 


        <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_image_logo_title', 1) }}</label>

        <div class="col-lg-3 fv-row">
                <input type="file" class="form-control form-control-lg form-control-solid" name="company_image_logo" accept=".png, .jpg, .jpeg">
        </div>

    </div>
    
    <div class="row mb-6">

    <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_address_title', 1) }}</label>
            
            <div class="col-lg-3 fv-row">
                {!! Form::text('company_address', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.company_address', 1)]) !!}
            </div>

            <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_aboutus_title', 1) }}</label>
            
            <div class="col-lg-3 fv-row">
                {!! Form::text('company_aboutus', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.company_aboutus', 1)]) !!}
            </div>
    </div>

    <div class="row mb-6">
            <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ trans_choice('content.company_map_location_title', 1) }}</label>
            
            <div class="col-lg-12 fv-row">
                {!! Form::text('company_map_location', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.company_map_location', 1)]) !!}
            </div>
    </div>


</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\HostelServiceRequest', 'form') !!}
@endpush