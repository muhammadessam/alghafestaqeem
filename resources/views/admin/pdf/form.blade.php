@extends('admin.layouts.app')
@section('tab_name', __('admin.price_offer'))
@section('css')
    @livewireStyles
    @vite('resources/css/app.css')
@endsection

@section('content')
    <livewire:generate-pdf/>
@endsection
@section('js')
    @wireUiScripts
    @vite('resources/js/app.js')
    @livewireScripts
@endsection
