@extends('admin.layouts.app')
@section('tab_name', __('admin.Rates'))
@section('css')
<!--link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"-->
<style>
    <style>element.style {}

    svg.w-5.h-5 {
        width: 20px !important;
    }

</style>
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> @lang('admin.Rates')
                    <br> <br><i class="fa fa-wpforms"></i></fa> <span>عدد الطلبات : </span> <span class="">{{ $result['counts'] ?? '0' }}</span>

                </h4>

                <hr>
                @include('admin.rates.search')


                @if ($result['items']->count())
                <div class="table-responsive">
                    <table class="table table-sm table-striped" id="tableone">
                        @include('admin.rates.table')
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
@include('admin.rates.changeStatusModal')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.editStatus', function(e) {
            e.preventDefault();

            let id = $(this).attr('data-id');
            let status = $(this).attr('data-status');
            $('#status option[value="' + status + '"]').attr("selected", "selected");
            let url = "{{ route('admin.rates.update', ':id') }}";
            url = url.replace(':id', id);
            $('#changeStatusForm').attr('action', url);
            $('#changeStatusModal').modal('show');
        })


    });

</script>

<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
<script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

@endsection
