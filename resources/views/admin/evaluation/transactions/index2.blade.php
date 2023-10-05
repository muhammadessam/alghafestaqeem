@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))

@section('css')
    @vite(['resources/css/app.css','resources/js/app.js'])
@endsection

@section('content')
    <div class="w-full" dir="rtl">
        <div class="row">
            <div class="col-12">
                @if (can('evaluation-transactions.create'))
                    <a class="btn btn-success pull-right text-white"
                       href="{{ route('admin.evaluation-transactions.create') }}">
                        <i class=" icon-plus"></i>
                    </a>
                @endif
            </div>
        </div>
        <livewire:evaluation-transaction-table></livewire:evaluation-transaction-table>
    </div>
@endsection
