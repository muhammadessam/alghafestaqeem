<div class="form-group">
    <div id="mapCanv" style="width:100%;height:400px"></div>
    <input type="hidden" class="locationId" name="latitude" id="latitude" />
    <input type="hidden" class="locationId" name="longitude" id="longitude" />

</div>
<div class="form-group">
      <label class="wizard-form-text-label">(المنطقة - المدينة - الحي) تفاصيل العنوان <span>*</span></label>
    <input required class="form-control wizard-required" type="text" name="location" id="location" />
  
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.usage_id')])
        </span>
    </div>
</div>
