<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">
       
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Name</label>
  
        <div class="col-lg-4 fv-row">
            
            <!-- <input type="text"  class="form-control form-control-lg form-control-solid" name="name" placeholder="Name"> -->
            {!! Form::text('name', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.cat_name', 1)]) !!}
        </div>
       
        <label
            class="col-lg-2 col-form-label required fw-bold fs-6">cjhzxbvxbkjbvnxjbnclb</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            <!-- {!! Form::file('icon', null, ['placeholder' => trans_choice('content.icon_title', 1), 'value' => 'Max', 'class' => 'form-control form-control-lg form-control-solid']) !!} -->
            <input type="file" class="form-control form-control-lg form-control-solid" name="icon" accept=".png, .jpg, .jpeg">
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
            <input class="form-check-input" type="radio" id="flexSwitchCheckDefault" value="0" name="status">&nbsp;Yes
            <input class="form-check-input" type="radio" id="flexSwitchCheckDefault" value="1" name="status">&nbsp;No
        </div>
        <!--end::Col-->
      
    </div>
  

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\AdvisorieRequest', 'form') !!}
@endpush
