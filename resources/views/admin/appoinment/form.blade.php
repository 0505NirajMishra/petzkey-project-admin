<!--begin::Card body-->
<div class="card-body">
    
    <!--begin::Input group-->
    <div class="row mb-6">
        

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.appt_date_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::date('appt_date_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.appt_date_time', 1)]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.book_date_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::date('book_date_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.book_date_time', 1)]) !!}
        </div> 

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.payment_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('payment', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.payment', 1)]) !!}
        </div>


        <label class="col-lg-2 col-form-label required fw-bold fs-6">Status</label>    

        <div class="col-lg-3 fv-row mt-3">
            <select class="form-control form-control-solid" name="progress_status">
              <option value=""> Please select status</option>
              <option value="0">Upcoming</option>
              <option value="1">Completed</option>
              <option value="2">Canceled</option>
            </select>
        </div>


    </div>
  

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\HostelAppoinmentRequest', 'form') !!}
@endpush