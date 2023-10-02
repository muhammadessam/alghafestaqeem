<style>
    table.dataTable.table-sm>thead>tr>th{
        text-align:right;
    }
    table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){
          text-align:right !important;
    }
</style>
<thead>
    <tr class="table-primary">
        <th>#</th>
        <th> @lang('admin.instrument_number')</th>
        <th> @lang('admin.transaction_number')</th>
                <th> @lang('admin.phone')</th>

        <th> @lang('admin.Company')</th>
        <th> @lang('admin.region')</th>
        <th> @lang('admin.company_fundoms')</th>
        <th> @lang('admin.review_fundoms')</th>
        <th> @lang('admin.previewer')</th>


        <th> @lang('admin.TransactionDetail')</th>
        <th> @lang('admin.iterated')</th>
        <th> @lang('admin.Status')</th>
        <th>اخر تحديث</th>
         <th>الملاحظات</th>
        <th>@lang('admin.Actions')</th>
    </tr>
</thead>

<tbody>
    @foreach ($result['items'] as $item)
        <tr>
            <td class="{{ $item->is_iterated == 1 ? 'bg-danger' : '' }}">
                <strong>{{ $item->id }}</strong>
                   <br>
                   {{ $item->dateFormatted('d M Y', 'date') }}

            </td>

            <td>
                {{ $item->instrument_number }}
            </td>


            <td>
                {{ $item->transaction_number }}
            </td>
             <td>
                {{ $item->phone }}
            </td>

            <td>
                {{ $item->company ? $item->company->title : '' }}
            </td>

            <td>
                 {!! $item->region !!} 
            </td>
             <td>
                 {{ $item->company_fundoms }}
            </td> <td>
                  {{ $item->review_fundoms }}
            </td>
            <td>
                    {{ $item->previewer ? $item->previewer->title : '' }}
            </td>
            <td>

                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.type_id'):
                    </strong>
                    {{ $item->type ? $item->type->title : '' }}
                </p>

                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.owner_name'):
                    </strong>
                    {!! $item->owner_name !!}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.city'):
                    </strong>
                     {{ $item->city ? $item->city->title : '' }}
                </p>

                <!--<p>-->
                <!--    <strong class="text-dark " style="padding-left: 10px">@lang('admin.previewer'):-->
                <!--    </strong>-->

                <!--    {{ $item->previewer ? $item->previewer->title : '' }}-->
                <!--</p>-->

                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.review'):
                    </strong>

                    {{ $item->review ? $item->review->title : '' }}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.income'):
                    </strong>

                    {{ $item->income ? $item->income->title : '' }}

                </p>
                 <!--  -->
               
               
                <!--  -->
            </td>

            <td>
                {!! $item->iterated_span !!}
            </td>
            <td>{!! $item->status_span !!}
                @if (can('evaluation-transactions.change-status') && $item->status != 4)
                    <button type="button" data-id="{{ $item->id }}" data-status="{{ $item->status }}"
                        class="btn btn-sm btn-warning editStatus"><i class="text-white fa fa-edit"></i>
                    </button>
                @endif
            </td>


            <td>{{ $item->dateFormatted('d M Y', 'updated_at') }}</td>
            <td>{!! $item->notes !!}</td>
            <td>
                @if (can('evaluation-transactions.show'))

                    <a class="btn btn-sm btn-primary"
                        href="{{ route('admin.evaluation-transactions.show', $item->id) }}">
                        <i class="text-white fa fa-eye"> </i>
                    </a>
                @endif
                @if (can('evaluation-transactions.edit'))
                
                    <!--<a class="btn btn-sm btn-warning"-->
                    <!--    href="{{ route('admin.evaluation-transactions.edit', $item->id,['company' => $result['company']['id']]) }}">-->
                    <!--    <i class="text-white fa fa-edit"></i>-->
                    <!--</a>-->
                      <form action="{{ route('admin.evaluation-transactions.edit', $item->id) }}" method="get"
                        style="display: inline;" >
                        {{ csrf_field() }}
                        <input type="hidden" name="company" value="{{$result['company']['id']}}">

                        <button type="submit" class="btn btn-sm btn-warning">                        <i class="text-white fa fa-edit"></i>

                        </button>
                    </form>
                @endif
                @if (can('evaluation-transactions.destroy'))
                    <form action="{{ route('admin.evaluation-transactions.destroy', $item->id) }}" method="POST"
                        style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" class="btn btn-sm btn-danger"><i class="text-white fa fa-trash"></i>
                        </button>
                    </form>
                @endif

            </td>
        </tr>
    @endforeach
    
</tbody>
<tfooter>
    <tr>
        <td><span class="badge badge-danger">{{ $result['counts'] ?? '0' }}</span>
                       
                        @if (!empty($result['transaction'])))
                            <p>
                                <span class="text-danger bold">عدد المعاملات : {{ $result['transaction'] ?? '0' }}</span>
                             </p>
                        @endif</td>
        <td></td>
                <td></td>

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
         <td></td>
                  <td></td>

         <td></td>
           <td></td>
         <td></td>
          
        
         
    </tr>
</tfooter>
