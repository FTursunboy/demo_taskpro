@extends(auth()->user()->hasRole('crm') ? 'user.layouts.app' : 'admin.layouts.app')

@section('title')
    Изменение лида
@endsection

@section('content')
    <div id="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Изменение лида</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('lead.index') }}">Лиды</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Изменение лида</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <a href="{{ route('lead.index') }}" class="btn btn-outline-danger">
                    Назад
                </a>
            </div>
            @if($errors->any())
                @foreach($errors as $error)
                    {{$error}}
                @endforeach
                @endif
            <div class="card-body">
                <form action="{{ route('lead.update', $lead->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fio">ФИО<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="fio" name="fio" tabindex="1" class="form-control mt-3"
                                       placeholder="Введите ФИО" value="{{$lead->contact?->fio}}" required>
                                @if($errors->has('fio')) <p
                                    style="color: red;">{{ $errors->first('fio') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label for="start">Телефон</label>
                                <input placeholder="Введите номер телефона" type="text" id="phone" name="phone" class="form-control mt-3" tabindex="4" value="{{$lead->contact?->phone}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Стадии<span
                                        class="text-danger">*</span></label>
                                <select id="type" name="status_id" tabindex="7" class="form-select mt-3" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{$status->id === $lead->status->id ? 'selected' : ''}} {{$lead->status->id !== 1 && $status->id === 1 ? 'disabled' : ''}}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            @if($errors->has('status_id')) <p
                                    style="color: red;">{{ $errors->first('status_id') }}</p> @endif
                            </div>
                            @if($lead->contact?->is_client === 0 && $lead->status?->id === 1)
                                <div class="form-group" id="is_client">
                                    <label for="is_client" class="custom-label">Сохранение контакта</label>
                                    <input type="checkbox" class="custom-control-input" name="is_client">
                                </div>
                            @endif
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finish">Email</label>
                                <input placeholder="Введите Email" type="text" id="email" name="email" class="form-control mt-3" tabindex="2" value="{{$lead->contact?->email}}" >
                            </div>
                            <div class="form-group">
                                <label for="">Источник лида<span
                                        class="text-danger">*</span></label>
                                <select  id="type" name="source_id" tabindex="5" class="form-select mt-3" required>
                                    <option value="">Выберите источник</option>
                                    @foreach($sources as $source)
                                        <option value="{{ $source->id }}" {{$source->id === $lead->leadSource->id ? 'selected' : ''}}>{{ $source->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('source_id')) <p
                                    style="color: red;">{{ $errors->first('source_id') }}</p> @endif
                            </div>
                            <div class="form-group col-12">
                                <label for="description">Описание</label>
                                <textarea id="description" name="description" class="form-control mt-3" tabindex="8">{{$lead->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type">Адрес</label>
                                <input type="text" name="address" placeholder="Введите адрес" value="{{$lead->contact?->address}}" class="form-control mt-3" tabindex="3">
                            </div>
                            <div class="form-group">
                                <label for="">Состояние <span
                                        class="text-danger">*</span></label>
                                <select id="type" name="state_id" tabindex="6" class="form-select mt-3" required>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ $state->id === $lead->state->id ? 'selected' : ''}}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('state_id')) <p
                                    style="color: red;">{{ $errors->first('state_id') }}</p> @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" id="button" class="btn btn-outline-primary" tabindex="9">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                if ($(this).val() != '1') {
                    $('#is_client').addClass('d-none');
                } else {
                    $('#is_client').removeClass('d-none');
                }
            });
        });
    </script>
@endsection
