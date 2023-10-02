<table class="table table-sm table-striped" style=" text-align:right !important;">
    <thead>
        <tr   class="table-primary">
            <th>id</th>
            <th> رقم الصك</th>
            <th>رقم المعاملة</th>
            <th> رقم الهاتف</th>
            <th> الشركة</th>
            <th>المدينة</th>
            <th> أتعاب الشركة</th>
            <th> اتعاب المعاين</th>
            <th> المعاين</th>
            <th> تفاصيل</th>
            <th> مكرر</th>
            <th> حالة</th>
            <th>اخر تحديث</th>
            <th>الملاحظات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)

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
            </td>
            <td>
                {{ $item->review_fundoms }}
            </td>
            <td> {{ $item->previewer ? $item->previewer->title : '' }}
            </td>
            <td>

                <p>
                    <strong class="text-dark " style="padding-left: 10px">نوع العقار:
                    </strong>
                    {{ $item->type ? $item->type->title : '' }}
                </p>

                <p>
                    <strong class="text-dark " style="padding-left: 10px">أسم المالك:
                    </strong>
                    {!! $item->owner_name !!}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">الفرع:
                    </strong>
                    {{ $item->city ? $item->city->title : '' }}
                </p>



                <p>
                    <strong class="text-dark " style="padding-left: 10px">المراجعة:
                    </strong>

                    {{ $item->review ? $item->review->title : '' }}
                </p>
                <p>
                    <strong class="text-dark " style="padding-left: 10px">الأدخال:
                    </strong>

                    {{ $item->income ? $item->income->title : '' }}

                </p>

            </td>
            <td>
                {!! $item->iterated_span !!}
            </td>
            <td>{!! $item->status_span !!}

            </td>


            <td>{{ $item->dateFormatted('d M Y', 'updated_at') }}</td>


        </tr>

        @endforeach
    </tbody>
</table>