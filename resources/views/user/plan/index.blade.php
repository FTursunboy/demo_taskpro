@extends('user.layouts.app')

@section('title')Мои планы@endsection


@section('content')
    <div id="page-heading">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Мои планы</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Мои планы</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')
        <a href="{{ route('user.index') }}" class="btn btn-danger {{ (count($myPlan) > 0) ? 'disabled' : '' }}">Назад</a>
        <a href="" class="btn btn-primary">Добавить новый план</a>
        <section class="section">

            <div class="row">

            </div>
        </section>
    </div>
@endsection
