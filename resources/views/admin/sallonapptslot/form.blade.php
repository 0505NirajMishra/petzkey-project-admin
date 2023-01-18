<!--begin::Card body-->
<div class="card-body">
    
    <!--begin::Input group-->
    <div class="row mb-6">        
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.sallon_mrg_slot_title', 1) }}</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('sallon_mrg_slot', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.sallon_mrg_slot', 1)]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.sallon_evg_slot_title', 1) }}</label>
   
        <div class="col-lg-4 fv-row">
            {!! Form::text('sallon_evg_slot', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.sallon_evg_slot', 1)]) !!}
        </div>

    </div>

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SallonApptslotRequest', 'form') !!}
@endpush