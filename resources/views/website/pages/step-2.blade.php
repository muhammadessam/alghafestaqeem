<div class="form-group">
    <select class="form-control" required id="type_id" name="type_id">
        <option value="" hidden selected></option>

        @if (!empty($result['types']))
            @foreach ($result['types'] as $type)
                <option value="{{ $type->id }}">{{ $type->title }}</option>
            @endforeach
        @endif

    </select>
    <label class="wizard-form-text-label" for="type_id"> نوع العقار محل التقييم<span>*</span></label>
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.type_id')])
        </span>
    </div>


</div>
<div class="form-group">
     <label class="wizard-form-text-label">تفاصيل العقار </label>
    <textarea class="form-control" name="real_estate_details" rows="6">
    </textarea>
   
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.real_estate_details')])
        </span>
    </div>


</div>
<div class="form-group">
     <label class="wizard-form-text-label" for="entity_id"> الجهه الموجه اليها التقييم </label>
    <select required class="form-control wizard-required" id="sector" name="entity_id">
        <option value="" hidden selected></option>

        @if (!empty($result['entities']))
            @foreach ($result['entities'] as $entity)
                <option value="{{ $entity->id }}">{{ $entity->title }}</option>
            @endforeach
        @endif
    </select>
   
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.entity_id')])
        </span>
    </div>


</div>
<div class="form-group">
     <label class="wizard-form-text-label" for="real_estate_age"> العمر <span>*</span></label>
    <input class="form-control wizard-required" required type="number" name="real_estate_age" />
   
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.real_estate_age')])
        </span>
    </div>
</div>

<div class="form-group">
      <label class="wizard-form-text-label" for="real_estate_area"> المساحة <span>*</span></label>
    <input class="form-control wizard-required" required type="number" name="real_estate_area" />
  
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.real_estate_area')])
        </span>
    </div>


</div>

<div class="form-group">
     <label class="wizard-form-text-label" for="usage_id"> استعمال العقار </label>
    <select required class="form-control wizard-required" id="sector" name="usage_id">
        <option value="" hidden selected></option>
        @if (!empty($result['usages']))
            @foreach ($result['usages'] as $usage)
                <option value="{{ $usage->id }}">{{ $usage->title }}</option>
            @endforeach
        @endif

    </select>
   
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.usage_id')])
        </span>
    </div>
</div>
