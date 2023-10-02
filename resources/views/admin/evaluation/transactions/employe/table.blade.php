<style>
table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled) {
    text-align: right !important;
}
</style>
<thead>
    <tr class="table-primary">
        <th>#</th>

        <th> @lang('admin.Title')</th>
        <th>  إجمالى المعاملات</th>
        <th> المعاينات</th>
        <th> الإدخال</th>
        <th> المراجعة</th>

    </tr>
</thead>

<tbody>
    @foreach ($result['items'] as $i=>$item)
        <tr>
            <td class="">
                <strong>{{ $i+1 }}</strong>
                 

            </td>

            <td>
                {{ $item->title }}
            </td>


            <td>
                {{ ((count($item->Transactionreview)+count($item->Transactionincome))*.5)+count($item->Transactionpreviewer) }}
            </td>
            <td>
                {{ count($item->Transactionpreviewer) }}
            </td>
            
            
            <td>
                {{ count($item->Transactionincome)*.5 }}
            </td>
<td>
                {{ count($item->Transactionreview)*.5 }}
            </td>
           

          
        </tr>
    @endforeach
   
</tbody>
<tfoot>
            <tr>
            <td><span class="badge badge-danger">{{ $result['counts'] ?? '0' }}</span>
                       
                      
       </td>
       <td></td>
       <td></td>
      

            </tr>
</tfoot>
