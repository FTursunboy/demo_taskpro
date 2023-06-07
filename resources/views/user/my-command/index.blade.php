@extends('user.layouts.app')
@section('title')
    Моя команда
@endsection

@section('content')

    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Моя команда</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Панель</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Моя команда</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @include('inc.messages')
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <h3 class="text-center">В разработке</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection


