@extends('admin.layouts.app')

@section('title')
    Проекты
@endsection

@section('content')
    <div id="main">
        @include('.inc.messages')
        <div class="card">
            <div class="card-header">
                <a href="{{ route('project.create') }}" class="btn btn-outline-primary">
                    Добавить проект
                </a>
            </div>
            <div class="card-bode"></div>
            <div class="card-footer"></div>
        </div>
    </div>
@endsection
