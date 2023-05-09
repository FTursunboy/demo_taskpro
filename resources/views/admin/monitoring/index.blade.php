@extends('admin.layouts.app')

@section('title')
    Мониторинг
@endsection

@section('content')
    <div id="main">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мониторинг</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Панел</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мониторинг</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('inc.messages')

        <div class="container mt-3 d-flex justify-content-center">
            @foreach($statuses as $status)
                @switch($status->name)
                    @case($status->name === "Ожидается")
                    <span><i class="bi bi-circle-fill text-warning mx-2"></i>{{ $status->name }}</span>
                    @break
                    @case($status->name === "Принято")
                    <span><i class="bi bi-circle-fill text-success mx-2"></i>{{ $status->name }}</span>
                    @break
                    @case($status->name === "Отклонено")
                    <span><i class="bi bi-circle-fill text-danger mx-2"></i>Отклонено</span>
                    @break
                    @case($status->name === "В процессе")
                    <span><i class="bi bi-circle-fill text-primary mx-2"></i>В процессе</span>
                    @break
                    @case($status->name === "Просроченный")
                    <span><i class="bi bi-circle-fill text-info mx-2"></i>Просроченный</span>
                    @break
                    @case($status->name === "На проверку")
                    <span><i class="bi bi-circle-fill text-secondary mx-2"></i>На проверку</span>
                    @break
                    @case($status->name === "Готов")
                    <span><i class="bi bi-circle-fill mx-2" style="color: #00ff80"></i>Готов</span>
                    @break
                @endswitch
            @endforeach
            <span><i class="bi bi-circle-fill mx-2" style="color: rgba(134,0,180,0.67)"></i>Все</span>
        </div>

        <div class="row mt-4">
            <div class="col-3">
                @include('admin.monitoring.statuses')
            </div>
            <div class="col-3">
                @include('admin.monitoring.users')
            </div>
            <div class="col-3">
                @include('admin.monitoring.clients')
            </div>
            <div class="col-3">
                @include('admin.monitoring.projects')
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
