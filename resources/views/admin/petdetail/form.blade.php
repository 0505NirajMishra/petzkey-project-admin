<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">
        
        <!--begin::Label-->

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_type_title', 1) }}</label>

      
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_type', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_type', 1)]) !!}
        </div>
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_image_title', 1) }}</label>

        <div class="col-lg-4 fv-row">            
            <input type="file" class="form-control form-control-lg form-control-solid" name="pet_image" accept=".png, .jpg, .jpeg">
        </div>

        
        <!--end::Col-->

    </div> 

    <div class="row mb-6">
        
        <!--begin::Label-->

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_year_title', 1) }}</label>

      
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_year', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_year', 1)]) !!}
        </div>
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_month_title', 1) }}</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_month', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_month', 1)]) !!}
        </div>

        
        <!--end::Col-->

    </div>

    <div class="row mb-5 mt-3">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_breed_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_breed', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_breed', 1)]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_gender_title', 1) }}</label>

        <div class="col-lg-4 fv-row mt-5">
            <input type="radio" value="male" name="pet_gender" required class="form-check-input" /> &nbsp; Male
            <input type="radio" value="female" name="pet_gender" required class="form-check-input"/> &nbsp; Female
        </div>

    </div> 

    <div class="row mb-6">
        
        <!--begin::Label-->

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_height_title', 1) }}</label>

      
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_height', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_height', 1)]) !!}
        </div>
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_weight_title', 1) }}</label>

        <div class="col-lg-4 fv-row">            
        {!! Form::text('pet_weight', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_weight', 1)]) !!}
        </div>

        
        <!--end::Col-->

    </div>
  

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PetDetailRequest', 'form') !!}
@endpush
