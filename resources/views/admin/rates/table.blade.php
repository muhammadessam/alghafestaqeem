<thead>
    <tr class="table-primary">
        <th class="text-xs-center">#</th>
        <th class="text-xs-center">#</th>

        <th> @lang('admin.Customer')</th>
        <th> @lang('admin.ApartmentDetail')</th>
        <th> @lang('admin.Status')</th>

        <th> اخر تحديث</th>
         <th>ملاحظات</th>
        <th class="text-xs-right">@lang('admin.Actions')</th>
    </tr>
</thead>

<tbody>
    @foreach ($result['items'] as $item)
        <tr>
            <td>{{$item->id}}</td>
           <td>

               {{ $item->id }}
               <br/>
                {{ $item->dateFormatted('d M Y', 'created_at') }}
                <a class="btn btn-sm btn-primary" href="{{ route('admin.rates.show', $item->id) }}">
                    <i class="text-white fa fa-eye"> </i> {{ $item->request_no }}
                </a>
           </td>

            <td>

                <p>
                    <strong class="text-dark ">الاسم:
                    </strong> {{ $item->name }}
                </p>
                <p>
                    <strong class="text-dark ">البريد الإلكتروني:
                    </strong>{!! $item->email !!}
                </p>
                <p>
                    <strong class="text-dark ">رقم الجوال:
                    </strong> {!! $item->mobile !!}
                    <a href="https://wa.me/966{!! $item->mobile !!}"><i class="fa fa-whatsapp fa-2x"
                            style="color:#25d366"></i></a>
                    <a href="tel:966{!! $item->mobile !!}"><i class="fa fa-mobile fa-2x"
                            style="color:#1d8496"></i></a>
                </p>
                <p>
                    <strong class="text-dark "> @lang('admin.Notes'): </strong>
                    </strong>
                 </p>

            </td>
            <td>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.ApartmentGoal'):
                    </strong>
                    {{ $item->goal ? $item->goal->title : '' }}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.ApartmentType'):
                    </strong>
                    {{ $item->type ? $item->type->title : '' }}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.ApartmentEntity'):
                    </strong>{{ $item->entity ? $item->entity->title : '' }}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.ApartmentAge'):
                    </strong>
                    {!! $item->real_estate_age !!}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.ApartmentArea'):
                    </strong>
                    {!! $item->real_estate_area !!}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">@lang('admin.ApartmentUsed'):
                    </strong>
                    {{ $item->usage ? $item->usage->title : '' }}
                </p>
            </td>

            <td>{!! $item->status_span !!}

                @if ($item->status < 2 && can('rates.change-status'))
                    <button type="button" data-id="{{ $item->id }}" data-status="{{ $item->status }}"
                        class="btn btn-sm btn-warning editStatus"><i class="text-white fa fa-edit"></i>
                    </button>
                @endif
            </td>

            <td>{{ $item->dateFormatted('d M Y', 'updated_at') }}</td>
            <td>  {!! $item->notes !!}</td>
            <td >
                @if (can('rates.edit'))

                    <a class="btn btn-sm btn-warning" href="{{ route('admin.rates.edit', $item->id) }}">
                        <i class="text-white fa fa-edit"></i>
                    </a>
                @endif
                @if (can('rates.destroy'))
                    <form action="{{ route('admin.rates.destroy', $item->id) }}" method="POST"
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

