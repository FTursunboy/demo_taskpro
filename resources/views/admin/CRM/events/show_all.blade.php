@extends('admin.layouts.app')

@section('title')
    События
@endsection
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('event.create') }}" class="btn btn-outline-primary">
                    Добавить событие
                </a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-hover">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Тема</th>
                        <th>Контакт</th>
                        <th>Описание</th>
                        <th>Дата</th>
                        <th>Тип</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $event->themeEvent?->theme }}</td>
                            <td>{{ $event->contact?->phone }}</td>
                            <td>{{ $event->description}}</td>
                            <td>{{ date('d.m.Y', strtotime($event->date)) }}</td>
                            <td>{{ $event->typeEvent?->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('event.show', $event->id)   }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-danger" data-bs-toggle="modal"
                                   data-bs-target="#delete{{$event->id}}"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade text-left" id="delete{{$event->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="delete{{$event->id}}" data-bs-backdrop="false" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="delete{{$event->id}}">Предупреждение</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Точно хотите удалить проект?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Нет, я пошутил</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Да, точно</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endsection
@section('script')
    <script src="{{asset('assets/js/search.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>
    <script>
        $(document).ready(function () {



            var table = $('#example').DataTable({
                initComplete: function () {

                },
            });
        });
    </script>
@endsection
