@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))
@section('css')
    @filamentStyles
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="w-full" dir="rtl">
        <div class="row mb-5">
            <div class="col-12">
                <livewire:filters/>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <livewire:companies-count-widget/>
            </div>
            <div class="col-6">
                <livewire:status-count-widget/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <livewire:entry-employee-count-widget/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <livewire:previewer-employee-count-widget/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <livewire:reviewer-employee-count-widget/>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @filamentScripts
    @vite('resources/js/app.js')
@endsection
