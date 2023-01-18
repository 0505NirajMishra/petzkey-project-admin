<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">
        
        <!--begin::Label-->

        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.cat_name_title', 1) }}</label>

      
        <div class="col-lg-4 fv-row">
            {!! Form::text('cat_name', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.cat_name', 1)]) !!}
        </div>
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.cat_image_title', 1) }}</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="cat_image" accept=".png, .jpg, .jpeg">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Status</label>

        <!-- <div class="col-lg-3 fv-row">    
                <input type="checkbox" checked data-toggle="toggle" data-size="lg" />
        </div> -->
        <div class="col-lg-3 fv-row mt-3">
            <select class="form-control form-control-solid" name="cat_status">
              <option value=""> Please select status</option>
              <option value="0">Active</option>
              <option value="1">Deactive</option>
            </select>
        </div>

        <!--end::Col-->

    </div>
  

</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryRequest', 'form') !!}
@endpush
