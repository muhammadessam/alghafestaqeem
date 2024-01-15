@extends('admin.layouts.app')
@section('tab_name', __('admin.contracts.create'))
@section('css')
@filamentStyles
@vite('resources/css/app.css')
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">@lang('admin.contracts.nav') / @lang('admin.contracts.create')</h4>
        <hr>
        <livewire:contracts.create-contract />
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<livewire:notifications />
@filamentScripts
@vite('resources/js/app.js')
@endsection