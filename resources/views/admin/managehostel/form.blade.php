<!--begin::Card body-->
<div class="card-body">

 
    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.opening_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('opening_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.opening_time', 1)]) !!}
        </div>
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_image_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="pet_image" accept=".png, .jpg, .jpeg">
        </div>
    </div> 

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.closing_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('closing_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.closing_time', 1)]) !!}
        </div>
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_type_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_type', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_type', 1)]) !!}            
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_per_day_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_per_day', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_per_day', 1)]) !!}
        </div>
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_seat_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_seat', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_seat', 1)]) !!}
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_desc_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_desc', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_desc', 1)]) !!}
        </div>
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.pet_per_hour_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('pet_per_hour', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pet_per_hour', 1)]) !!}
        </div>
    </div>
    

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ManagehostelserviceRequest', 'form') !!}
@endpush