@extends('admin.layouts.app')
@section('tab_name', __('admin.contracts.index'))
@section('css')
@filamentStyles
@vite('resources/css/app.css')
@endsection

@section('content')
<livewire:contracts.list-contracts />
@endsection
@section('js')
<livewire:notifications />
@filamentScripts
@vite('resources/js/app.js')
@endsection
