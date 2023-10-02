@if (!empty($data))
    <option disabled value='' selected hidden>@lang('website.Select')</option>
    @foreach ($data as $item)
        <option value="{{ $item->id }}">{{ $item->title }}</option>
    @endforeach
@endif
