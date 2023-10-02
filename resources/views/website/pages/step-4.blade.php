<div class="form-group mb-3">
    <label class="wizard-form-text-label"> صورة الصك</label>
    <input class="form-control" type="file" name="instrument_image[]" multiple accept="image/*" />
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.instrument_image')])
        </span>
    </div>
</div>
<div class="form-group mb-3">
    <label class="wizard-form-text-label"> رخصه البناء </label>

    <input class="form-control" type="file" name="construction_license[]" multiple accept="image/*" />
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.construction_license')])
        </span>
    </div>
</div>
<div class="form-group mb-3">
    <label class="wizard-form-text-label"> مستندات اخري </label>
    <input class="form-control" type="file" name="other_contracts[]" multiple accept="image/*" />
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.other_contracts')])
        </span>
    </div>
</div>
