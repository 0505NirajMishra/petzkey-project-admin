<!--begin::Card body-->
<div class="card-body">
    <!--begin::Input group-->
    <div class="row mb-6">

       <label class="col-lg-2 col-form-label required fw-bold fs-6">Category List</label>

       <div class="col-lg-3 fv-row">

       <select class="form-control form-control-solid" name="cat_id">
                     <option value=""> Please select</option>
                     @foreach($categorys as $data)
                         <option value="{{$data->cat_id}}">{{$data->cat_name}}</option>
                     @endforeach
       </select>

      </div>

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.sub_name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-3 fv-row">
            {!! Form::text('sub_cat_name', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.sub_cat_name', 1)]) !!}
        </div>
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.sub_image_title', 1) }}</label>

        <div class="col-lg-3 fv-row mt-3">
            <!-- {!! Form::file('icon', null, ['placeholder' => trans_choice('content.icon_title', 1), 'value' => 'Max', 'class' => 'form-control form-control-lg form-control-solid']) !!} -->
            <input type="file" class="form-control form-control-lg form-control-solid" name="sub_cat_image" accept=".png, .jpg, .jpeg">
        </div>

        <!--end::Col-->

    </div>
  

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SubcategoryRequest', 'form') !!}
@endpush
