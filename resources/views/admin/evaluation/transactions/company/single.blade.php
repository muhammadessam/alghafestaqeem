@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))
@section('css')
    @vite(['resources/css/app.css','resources/js/app.js'])
@endsection
@section('content')
    <livewire:evaluation-transaction-table :company="$result['company']['id']"></livewire:evaluation-transaction-table>
@endsection
