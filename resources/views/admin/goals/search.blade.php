<form action="{{ route('admin.goals.index') }}" method="GET">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <input type="text" name="search" class="form-control" placeholder="@lang('admin.SearchNow')" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <select class="form-control" name="status">
                <option value="">@lang('admin.AllStatus')</option>
                <option {{ $result['status'] == '1' ? 'selected' : '' }} value="1">@lang('admin.Yes')
                </option>
                <option {{ $result['status'] == '0' ? 'selected' : '' }} value="0">@lang('admin.No')
                </option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" name="from_date" class="form-control" format="YYYY-MM-DD" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" name="to_date" class="form-control" format="YYYY-MM-DD" />
        </div>

        <div class="col-md-1 col-sm-6 col-xs-12 form-group ">
            <button type="submit" class="btn btn-primary">@lang('admin.Search')</button>
        </div>
    </div>
</form>
