@extends('admin.layouts.app')
@section('tab_name', __('admin.contracts.index'))
@section('css')
@filamentStyles
@vite('resources/css/app.css')
@endsection

@section('content')
<div class="w-full" dir="rtl">
  <div class="row">
    <div class="col-12">
      @if (can('contracts.create'))
      <a class="btn btn-success pull-right text-white" href="{{ route('admin.contracts.create') }}">
        <i class=" icon-plus"></i>
      </a>
      @endif
    </div>
  </div>
  <livewire:contracts.index />
</div>
@endsection
@section('js')
<livewire:notifications />
@filamentScripts
@vite('resources/js/app.js')
@endsection