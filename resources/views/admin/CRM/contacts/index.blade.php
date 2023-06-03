@extends('admin.layouts.app')

@section('title')
    Контакты
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Контакты</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Контакты</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('.inc.messages')
        <section class="section">
            <div class="card">
                <div class="card-header">
                        <a href="{{ route('contact.create') }}" class="btn btn-outline-primary">
                        Добавить контакт
                    </a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Адрес</th>
                            <th>Лид</th>

                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $contact?->fio }}</td>
                                <td>{{ $contact?->phone }}</td>
                                <td>{{ $contact?->address }}</td>
                                <td>
                                    {{ $contact?->fio }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('contact.show', $contact->id)   }}" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#delete{{$contact->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="delete{{$contact->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="delete{{$contact->id}}" data-bs-backdrop="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="delete{{$contact->id}}">Предупреждение</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Точно хотите удалить контакт?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Нет</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Да</span>
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

    </div>
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

