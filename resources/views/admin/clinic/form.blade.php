<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">

        <div class="col-md-6">

        <label class="col-lg-6 col-form-label required fw-bold fs-6">{{ trans_choice('content.pettype_title', 1) }}</label>
               {!! Form::text('pettype', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.pettype', 1)]) !!}
        </div>

        <div class="col-md-6">
        <label class="col-lg-6 col-form-label required fw-bold fs-6">{{ trans_choice('content.clinic_fees_title', 1) }}</label>
               {!! Form::text('clinic_fees', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.clinic_fees', 1)]) !!}
        </div>

    </div>

    <div class="row mb-6">

        <div class="col-md-6">

        <label class="col-lg-6 col-form-label required fw-bold fs-6">{{ trans_choice('content.clinic_home_title', 1) }}</label>
               {!! Form::text('home_fees', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.home_fees', 1)]) !!}
        </div>

        <div class="col-md-6">
        <label class="col-lg-6 col-form-label required fw-bold fs-6">{{ trans_choice('content.clinic_desc_title', 1) }}</label>
               {!! Form::text('desc', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.desc', 1)]) !!}
        </div>

    </div>




</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ClinicServiceRequest', 'form') !!}
@endpush
