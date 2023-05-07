@extends('admin.layouts.app')

@section('title')Сотрудники@endsection


@section('content')
    <div id="main">
        <a href="{{ route('employee.create') }}" class="btn btn-outline-primary">
            Добавить новый сотрудник
        </a>
        @include('inc.messages')

        <div class="row pt-4">
            @foreach($users as $user)
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('assets/images/avatar-2.png') }}" alt="" width="100" height="100">
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                        <div class="card-footer"></div>
                    </div>
                    {{ $user->name }}
                </div>
            @endforeach
        </div>


    </div>

@endsection
@section('script')

@endsection
