<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_type_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_type', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_type', 1)]) !!}
        </div>
        
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_breed_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_breed', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_breed', 1)]) !!}
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

    <div class="row mb-6">

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_gender_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            <input type="radio" {{$petdetail->pet_gender == 'male' ? 'checked':''}}  value="male" name="pet_gender" /> &nbsp; Male
            <input type="radio" {{$petdetail->pet_gender == 'female' ? 'checked':''}} value="female" name="pet_gender" /> &nbsp; Female
        </div>
        
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_height_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_height', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_height', 1)]) !!}
        </div>

        <!--end::Col-->

    </div> 

    <div class="row mb-6">

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_weight_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_weight', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_weight', 1)]) !!}
        </div>
        
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_image_title', 1) }}</label>
        
        <div class="col-lg-4 fv-row">
        @if($petdetail->pet_id)
            <input type="file" class="form-control form-control-lg form-control-solid" name="pet_image" accept=".png, .jpg, .jpeg">
            <img src="{{ url('/') }}/petdetail/image/{{$petdetail->pet_image}}" height="50">
        @else
            <input type="file" class="form-control form-control-lg form-control-solid" name="pet_image" accept=".png, .jpg, .jpeg">
        @endif
        </div>

    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PetDetailRequest', 'form') !!}
@endpush