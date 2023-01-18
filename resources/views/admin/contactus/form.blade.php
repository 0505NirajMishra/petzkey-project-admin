<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">
       
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Name</label>
  
        <div class="col-lg-4 fv-row">
            
            <!-- <input type="text"  class="form-control form-control-lg form-control-solid" name="name" placeholder="Name"> -->
            {!! Form::text('user_name', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.user_name', 1)]) !!}
        </div>
       
        <label
            class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.phone_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            <!-- {!! Form::file('icon', null, ['placeholder' => trans_choice('content.icon_title', 1), 'value' => 'Max', 'class' => 'form-control form-control-lg form-control-solid']) !!} -->
            {!! Form::text('phone', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.phone_title', 1)]) !!}
        </div>
       
    </div>

    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="required">Status</span>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            
            <input class="form-check-input" type="radio" id="flexSwitchCheckDefault" value="male" name="gender">&nbsp;Male
            <input class="form-check-input" type="radio" id="flexSwitchCheckDefault" value="female" name="gender">&nbsp;Female
        </div>
        
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="required">Message</span>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            
        {!! Form::textarea('messages', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.messages_title', 1)]) !!}
        </div>
      
    </div>
  
   

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ContactUsRequest', 'form') !!}
@endpush
