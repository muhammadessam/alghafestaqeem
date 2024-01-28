@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))
@section('css')
<!--link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"-->
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> الأشعارات
                    <span class="badge badge-danger">{{count(auth()->user()->readNotifications)}}</span>


                </h4>
                <hr>


                @if (count(auth()->user()->readNotifications)>0)
                <div class="table-responsive">
                    <table class="table table-sm table-striped" id="evalution">
                        <thead>
                            <tr class="table-primary">
                                <th>#</th>
                                <th>الإشعار</th>
                                <th>المستخدم</th>
                                <th>التاريخ</th>
                                <th>التحكم</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->readNotifications as $i=>$notification)
                            @if ($notification->type == 'App\\Notifications\TimeNotification')
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>
                                    موعد
                                    @if($notification->data['appointment_type'] == 'preview') المعاينة
                                    @elseif($notification->data['appointment_type'] == 'income') الإدخال
                                    @elseif($notification->data['appointment_type'] == 'review') المراجعة
                                    @endif
                                    للمعاملة برقم الصك:
                                    {{ $notification->data['instrument_number'] }}
                                    قد اقترب، الرجاء تنبيه
                                    @if($notification->data['appointment_type'] == 'preview') المعاين
                                    @elseif($notification->data['appointment_type'] == 'income') المدخل
                                    @elseif($notification->data['appointment_type'] == 'review') المراجع
                                    @endif
                                    "{{ $notification->data['employee_name']}}"
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$notification->data['type']}}</td>
                                <td>{{$notification->data['user']['name']}}</td>
                                <td>{{$notification->created_at}}</td>
                                <td>
                                    @if (can('evaluation-transactions.destroy'))
                                    <form action="{{ url('admin/notification/delete/' .$notification->id.'') }}" method="get" style="display: inline;" onsubmit="return confirm('Delete? هل تريد مسح الاشعار?');">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="text-white fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>



                            </tr>
                            @endif

                            @endforeach
                        </tbody>

                    </table>
                </div>
                @else
                <div class="text-center">
                    <img src="/panel/images/empty-box.png" class="empty-box" />
                    <hr>
                    <h3 class="text-xs-center text-info">لا توجد أشعارات !</h3>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
<script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({

            dom: 'Bfrtip',
            //ordering: false,

            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });

    });
    $(document).ready(function() {
        $('#evalution').DataTable({

            dom: 'Bfrtip',
            //ordering: false,

            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });

    });

</script>




@endsection
