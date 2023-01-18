<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.cat_name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! Form::text('cat_name', null, ['min' => 2, 'max' => 6, 'value' => 2, 'class' => 'form-control form-control-lg form-control-solid', 'placeholder' => trans_choice('content.cat_name', 1)]) !!}
        </div>
        
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.cat_image_title', 1) }}</label>

        <div class="col-lg-4 fv-row">
            @if($category->cat_id)
            <input type="file" class="form-control form-control-lg form-control-solid" name="cat_image" accept=".png, .jpg, .jpeg">
            <img src="{{ url('/') }}/category/image/{{$category->cat_image}}" height="50">
        @else
            <input type="file" class="form-control form-control-lg form-control-solid" name="cat_image" accept=".png, .jpg, .jpeg">
        @endif
        </div>

        <!--end::Col-->

    </div>
  

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryRequest', 'form') !!}
@endpush
