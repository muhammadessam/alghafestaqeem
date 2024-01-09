@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))
@section('css')
    @filamentStyles
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="w-full" dir="rtl">
        <div class="row">
            <div class="col-12">
                @if (can('evaluation-transactions.create'))
                    <a class="btn btn-success pull-right text-white"
                       href="{{ route('admin.evaluation-transactions.create', ['company' => $result['company']['id']]) }}">
                        <i class=" icon-plus"></i>
                    </a>
                @endif
            </div>
        </div>
        <livewire:evaluation-transaction.index :company="$result['company']['id']"/>
    </div>
@endsection
@section('js')
    <livewire:notifications/>
    @filamentScripts
    @vite('resources/js/app.js')
@endsection
