@extends('admin.layouts.app')
@section('tab_name', __('admin.dashboard'))
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">مرحبا {{ auth()->user()->name }}</h3>
                    {{-- <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6> --}}
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        {{ date('D, M Y @ h:i') }}
                    </div>
                </div>
                <hr />

            </div>
        </div>

    </div>
    
    @if (can('dashboard.index'))
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">كل طلبات التقييم</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">النسبة:
                                    {{ $result['totalRequests'] > 0 ? ($result['totalRequests'] / $result['totalRequests']) * 100 : 0 }}
                                    %
                                </p>
                                <p class="text-muted">العدد: {{ $result['totalRequests'] ?? 0 }}</p>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-info" style="width: 100%;" role="progressbar"
                                    aria-valuenow="{{ $result['totalRequests'] ?? 0 }}" aria-valuemin="0"
                                    aria-valuemax="{{ $result['totalRequests'] ?? 0 }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">طلبات التقييم المنتهية</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">النسبة:
                                    {{ $result['totalRequests'] > 0 ? ($result['totalSuccessRequests'] / $result['totalRequests']) * 100 : 0 }}
                                    %
                                </p>
                                <p class="text-muted">العدد: {{ $result['totalSuccessRequests'] ?? 0 }}</p>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-success"
                                    style="width: {{ $result['totalRequests'] > 0 ? ($result['totalSuccessRequests'] / $result['totalRequests']) * 100 : 0 }}%;"
                                    role="progressbar" aria-valuenow="{{ $result['totalSuccessRequests'] ?? 0 }}"
                                    aria-valuemin="0" aria-valuemax="{{ $result['totalRequests'] ?? 0 }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">طلبات التقييم قيد الإنتظار</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">النسبة:
                                    {{ $result['totalRequests'] > 0 ? ($result['totalPendingRequests'] / $result['totalRequests']) * 100 : 0 }}
                                    %
                                </p>
                                <p class="text-muted">العدد: {{ $result['totalPendingRequests'] ?? 0 }}</p>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-warning"
                                    style="width: {{ $result['totalRequests'] > 0 ? ($result['totalPendingRequests'] / $result['totalRequests']) * 100 : 0 }}%;"
                                    role="progressbar" aria-valuenow="{{ $result['totalPendingRequests'] ?? 0 }}"
                                    aria-valuemin="0" aria-valuemax="{{ $result['totalRequests'] ?? 0 }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">طلبات التقييم الملغاة</h4>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">النسبة:
                                    {{ $result['totalRequests'] > 0 ? ($result['totalCancelledRequests'] / $result['totalRequests']) * 100 : 0 }}
                                    %
                                </p>
                                <p class="text-muted">العدد: {{ $result['totalCancelledRequests'] ?? 0 }}</p>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-danger"
                                    style="width: {{ $result['totalRequests'] > 0 ? ($result['totalCancelledRequests'] / $result['totalRequests']) * 100 : 0 }}%;"
                                    role="progressbar" aria-valuenow="{{ $result['totalCancelledRequests'] ?? 0 }}"
                                    aria-valuemin="0" aria-valuemax="{{ $result['totalRequests'] ?? 0 }}"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">أحدث طلبات التقييم</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            @include('admin.rates.table')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
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
        })

    </script>
@endsection
