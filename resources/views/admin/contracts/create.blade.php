@extends('admin.layouts.app')
@section('tab_name', __('admin.contracts.create'))
@section('css')
@filamentStyles
@vite('resources/css/app.css')
@endsection

@section('content')
<div class="w-full" dir="rtl">
  Create contract page
</div>
@endsection
@section('js')
<livewire:notifications />
@filamentScripts
@vite('resources/js/app.js')
@endsection