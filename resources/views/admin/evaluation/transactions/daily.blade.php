@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))
@section('css')
    @filamentStyles
    @vite('resources/css/app.css')
@endsection

@section('content')
    <x-notifications  z-index="z-50"/>
    <div class="w-full" dir="rtl">
        <div class="row">
            <div class="col-12">
                @if (can('evaluation-transactions.create'))
                    <a class="btn btn-success pull-right text-white" href="{{ route('admin.evaluation-transactions.create') }}">
                        <i class=" icon-plus"></i>
                    </a>
                @endif
            </div>
        </div>
        <livewire:evaluation-transaction.index :is_daily="true"/>
    </div>
@endsection
@section('js')
    <livewire:notifications/>
    @filamentScripts
    @vite('resources/js/app.js')
@endsection
