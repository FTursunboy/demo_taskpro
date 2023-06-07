@extends('admin.layouts.app')

@section('title')
    Идеи
@endsection
@section('content')
    <div id="page-heading">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Идеи сотрудников</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.ideas')}}">Идеи</a></li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                @if(session('mess'))
                    <div class="alert alert-success">
                        {{session('mess')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>От</th>
                                <th>До</th>
                                <th>Описание</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ideas as $idea)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{\Str::limit($idea->title, 60)}}</td>
                                    <td>{{$idea->from}}</td>
                                    <td>{{$idea->to}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($idea->description, 20)}}</td>
                                    @switch($idea->status->id)
                                        @case($idea->status->id === 1)
                                        <input type="text" class="form-control bg-warning text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 2)
                                        <input type="text" class="form-control bg-success text-white" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 3)
                                        <input type="text" class="form-control bg-success text-white" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 4)
                                        <input type="text" class="form-control bg-primary text-white" id="sts" value="В процессе" disabled>
                                        @break

                                        @case($idea->status->id === 5)
                                        <input type="text" class="form-control text-white" id="sts" value="{{ $idea->status->name }}" disabled style="background-color: #fc0404">
                                        @break

                                        @case($idea->status->id === 6)
                                        <input type="text" class="form-control bg-secondary text-white" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 7)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="Просроченный" disabled>
                                        @break

                                        @case($idea->status->id === 8)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 9)
                                        <input type="text" class="form-control bg-warning text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 10)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 11)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 12)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 13)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break

                                        @case($idea->status->id === 14)
                                        <input type="text" class="form-control bg-info text-black" id="sts" value="{{ $idea->status->name }}" disabled>
                                        @break
                                    @endswitch

                                    <td>
                                        <a class="text-primary" href="{{route('admin.idea.show', $idea->id)}}"><i
                                                class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7" class="text-center ">Пока нет идей</td>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>
        <footer>
            <div class="footer clearfix mb-0 text-muted">

            </div>
        </footer>
    </div>
    </div>

    <div class="modal" id="store" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить тип</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('settings.project.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection


