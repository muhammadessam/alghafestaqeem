@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))

@section('css')
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="w-full" dir="rtl">
        <livewire:evaluation-transaction-table></livewire:evaluation-transaction-table>
    </div>
@endsection
@section('js')
    @vite('resources/css/app.js')
@endsection
