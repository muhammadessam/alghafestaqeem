@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationCompanies'))
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> <span
                            class="badge badge-danger"></span>
                        @if (can('evaluation-companies.create'))

                        <form action="{{ route('admin.our_backup_database') }}" method="get">
                        <button style="submit" class="btn btn-primary"> download backup of database</button>
                         </form>
                        @endif
                    </h4>
                    <hr>
                   

                </div>
            </div>
        </div>
    </div>


@endsection
