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

        <th> @lang('admin.Title')</th>
        <th>  إجمالى المعاملة</th>
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
                {{ count($item->Transaction) }}
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
