@extends('admin.layouts.app')
@section('tab_name', __('admin.EvaluationTransaction'))
@section('css')
    @filamentStyles
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="w-full" dir="rtl">
        <div class="col-6">
            @livewire(\App\Livewire\BlogPostsChart::class)
        </div>
        <div class="col-6"></div>
    </div>
@endsection
@section('js')
    @filamentScripts
    @vite('resources/js/app.js')
@endsection
