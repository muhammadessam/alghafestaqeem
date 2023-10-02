<div class="form-group">
       <label class="wizard-form-text-label">الاسم بالكامل <span>*</span></label>
    <input class="form-control wizard-required" required="required" type="text" name="name"
        value="{{ old('name') }}" />
 
    <div class="wizard-form-error">

        <span class="mb-3">@lang('validation.required',['attribute'=> __('validation.attributes.name')])
        </span>
    </div>
</div>
<div class="form-group">
     <label class="wizard-form-text-label">رقم الجوال يبدا ب 05 <span>*</span></label>
    <input class="form-control wizard-required" required type="tel" name="mobile" value="{{ old('mobile') }}"  />
   
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.mobile')])
        </span>
    </div>
</div>
<div class="form-group">
     <label class="wizard-form-text-label"> البريد الاكتروني <span>*</span></label>
    <input class="form-control wizard-required" required type="email" name="email" value="{{ old('email') }}" />
   

    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.email')])
        </span>
    </div>
</div>
<div class="form-group">
      <label class="wizard-form-text-label"> عنوان  طالب التقييم <span>*</span></label>

    <input class="form-control wizard-required" required type="text" name="address" class="fotm-control"
        value="{{ old('address') }}" />
  
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.address')])
        </span>
    </div>
</div>
<div class="form-group">
    <label class="wizard-form-text-label">الغرض من التقييم<span>*</span></label>
    <select required class="form-control wizard-required" id="sector" name="goal_id">
        <option hidden selected></option>
        @if (!empty($result['goals']))
            @foreach ($result['goals'] as $goal)
                <option value="{{ $goal->id }}">{{ $goal->title }}</option>
            @endforeach
        @endif
    </select>
    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.goal_id')])
        </span>
    </div>

</div>
<div class="form-group">
    <label class="wizard-form-text-label">تفاصيل الغرض من طلب التقييم <span>*</span></label>
    <textarea class="form-control" rows="6" name="notes"></textarea>
    

    <div class="wizard-form-error">
        <span class="mb-3">@lang('validation.required',['attribute'=>
            __('validation.attributes.notes')])
        </span>
    </div>

</div>
