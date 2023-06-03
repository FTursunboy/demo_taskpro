@extends('admin.layouts.app')

@section('title')
    Таблицы
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Таблицы</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Таблицы</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('.inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Название таблиц</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Стадии лида</td>
                                <td class="text-center">
                                    <a href="{{route('setting.lead-status.index')}}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Источник лида</td>
                                <td class="text-center">
                                    <a href="{{route('setting.lead-source.index')}}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Состояние лида</td>
                                <td class="text-center">
                                    <a href="{{route('setting.lead-state.index')}}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Тема событий</td>
                                <td class="text-center">
                                    <a href="{{route('setting.theme-event.index')}}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Тип событий</td>
                                <td class="text-center">
                                    <a href="{{route('setting.type-event.index')}}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Статус событий</td>
                                <td class="text-center">
                                    <a href="{{route('setting.event-status.index')}}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
@endsection

