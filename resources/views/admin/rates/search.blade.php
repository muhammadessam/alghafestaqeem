<form action="{{ route('admin.rates.index') }}" method="GET">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12 form-group">
            <input type="text" value="{{ app('request')->input('search') ?? '' }}" name="search" class="form-control"
                placeholder="@lang('admin.SearchNow')" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <select class="form-control" name="status">
                <option value="" selected>كل الحالات</option>
                @foreach ($result['statuses'] as $status)
                    <option
                        {{ !empty(app('request')->input('status')) && app('request')->input('status') == $status['id'] ? 'selected' : '' }}
                        value="{{ $status['id'] }}">
                        {{ __('admin.' . $status['title']) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" value="{{ app('request')->input('from_date') ?? '' }}" name="from_date"
                class="form-control" format="YYYY-MM-DD" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" value="{{ app('request')->input('to_date') ?? '' }}" name="to_date"
                class="form-control" format="YYYY-MM-DD" />
        </div>

        <div class="col-md-1 col-sm-6 col-xs-12 form-group ">
            <button type="submit" class="btn btn-primary">@lang('admin.Search')</button>
        </div>
    </div>
</form>
