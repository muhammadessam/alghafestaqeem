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
                <h4 class="card-title"> @lang('admin.reviewTransactions')
                    <span class="badge badge-danger">{{ $result['counts'] ?? '0' }}</span>
                    @if (can('evaluation-transactions.create'))
                    <a class="btn btn-success pull-right text-white" href="{{ route('admin.evaluation-transactions.create') }}">
                        <i class=" icon-plus"></i>
                    </a>
                    @endif
                    @if (!empty($result['transaction'])))
                    <p>
                        <span class="text-danger bold">عدد المعاملات : {{ $result['transaction'] ?? '0' }}</span>
                        @if (!empty($result['previewer']))

                        <span class="text-danger bold">عدد المعاينة = {{ $result['previewer'] ?? '0' }}</span>

                        @endif
                        <!--  -->
                        @if (!empty($result['income']))

                        <span class="text-danger bold">عدد الإدخال = {{ ($result['income']*.5) ?? '0' }}</span>

                        @endif
                        <!--  -->
                        @if (!empty($result['review']))

                        <span class="text-danger bold">عدد المرجعات = {{ ($result['review']*.5) ?? '0' }}</span>

                        @endif
                    </p>
                    @endif
                </h4>
                <hr>

                @include('admin.evaluation.transactions.searchReview')

                @if ($result['items']->count())
                <div class="table-responsive">
                    <table class="table table-sm table-striped" id="evalution">
                        @include('admin.evaluation.transactions.table')
                    </table>
                </div>
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

@include('admin.evaluation.transactions.changeStatusModal')
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
<script>
    $(document).ready(function() {
        $(document).on('click', '.editStatus', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let status = $(this).attr('data-status');
            $('#status option[value="' + status + '"]').attr("selected", "selected");
            let url = "{{ route('admin.evaluation-transactions.update-status', ':id') }}";
            url = url.replace(':id', id);
            $('#changeStatusForm').attr('action', url);
            $('#changeStatusModal').modal('show');
        })
    });

</script>



@endsection
