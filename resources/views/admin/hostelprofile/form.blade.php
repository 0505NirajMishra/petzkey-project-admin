<!--begin::Card body-->
<div class="card-body">
    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">
            {{ trans_choice('content.hostel_image_title', 1) }}
        </label>
        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="hostel_image" accept=".png, .jpg, .jpeg">
        </div>
    </div> 
</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\HostelProfileRequest', 'form') !!}
@endpush