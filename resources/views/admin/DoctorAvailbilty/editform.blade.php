<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.avail_days_title', 1) }}</label>

        <div class="col-lg-4 fv-row">
        
        <select class="form-control form-control-solid selectpicker" name="avail_days[]" multiple>
            <option value=""> Please select availability </option>  
                
                @foreach($doctorava as $avail_days)
                <option 
                
                value="{{$avail_days->doctor_avail_id}}"      

                {{$avail_days->doctor_avail_id == $doctorava->avail_days ? 'selected' : '' }} 
                
                > 
                
                {{$avail_days->avail_days}}

                </option>
                @endforeach
                
        </select>

        </div>
    </div>  

    <div class="row mb-3 mt-3">Morning Session</div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.ms_opening_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::time('ms_opening_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.ms_opening_time', 1)]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.closing_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::time('ms_closing_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.ms_closing_time', 1)]) !!}
        </div>

    </div>

    <div class="row mb-3 mt-3">Closing Session</div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.es_opening_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::time('es_opening_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.es_opening_time', 1)]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.closing_time_title', 1) }}</label>
        <div class="col-lg-4 fv-row">
            {!! Form::time('es_closing_time', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.es_closing_time', 1)]) !!}
        </div>

    </div>

</div>
<!--end::Card body-->



@push('scripts')

    <script>

    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link   href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    {/*<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> */}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    {/* <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>*/} 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

        $(function () {
            $('.datetimepicker').datetimepicker();
        });

        $(document).ready(function() {
        $('select').selectpicker();
     });

    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DoctorAvaRequest', 'form') !!}
@endpush
