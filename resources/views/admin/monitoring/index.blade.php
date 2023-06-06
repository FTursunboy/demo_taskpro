@extends('admin.layouts.app')

@section('title')
    Мониторинг
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мониторинг</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мониторинг</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')
        <div class="container mt-2">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.statuses')
                </div>
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.unstatuses')
                </div>
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.users')
                </div>
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.clients')
                </div>
                <div class="col-sm-10 col-md-2 col-lg-2">
                    @include('admin.monitoring.projects')
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-12">
                <div id="tasks">
                    @include('admin.monitoring.tasks')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/ajax/monitoring.js') }}"></script>
@endsection
