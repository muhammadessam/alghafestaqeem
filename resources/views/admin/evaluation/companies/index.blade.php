@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationCompanies'))
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('admin.EvaluationCompanies') <span class="badge badge-danger">{{ $result['counts'] ?? '0' }}</span>
                    @if (can('evaluation-companies.create'))

                    <a class="btn btn-success pull-right text-white" href="{{ route('admin.evaluation-companies.create') }}">
                        <i class=" icon-plus"></i>
                    </a>
                    @endif
                </h4>
                <hr>
                @include('admin.evaluation.companies.search')
                @if ($result['items']->count())
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-xs-center">#</th>
                                {{-- <th>@lang('admin.Image')</th> --}}
                                <th>@lang('admin.Title')</th>
                                <th>@lang('admin.Position')</th>

                                <th>@lang('admin.Publish')</th>
                                <th>@lang('admin.CreationDate')</th>
                                <th class="text-xs-right">@lang('admin.Actions')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($result['items'] as $item)
                            <tr>
                                <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>
                                {{-- <td><img src="{{ $item->image ?? '' }}"></td> --}}
                                <td>{{ $item->title ?? '' }}</td>
                                <td>{!! $item->position !!}</td>
                                <td>{!! $item->active_span !!}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td class="text-left">
                                    @if (can('evaluation-companies.edit'))

                                    <a class="btn btn-sm btn-warning" href="{{ route('admin.evaluation-companies.edit', $item->id) }}">
                                        <i class="text-white icon-note"></i>
                                    </a>
                                    @endif
                                    @if (can('evaluation-companies.destroy'))
                                    <form action="{{ route('admin.evaluation-companies.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="text-white icon-trash"></i> </button>
                                    </form>

                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $result['items']->render() !!}
                @else
                <div class="text-center">
                    <img src="/panel/images/empty-box.png" class="empty-box" />

                    <hr>
                    <h3 class="text-xs-center text-info">No data addes !</h3>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
