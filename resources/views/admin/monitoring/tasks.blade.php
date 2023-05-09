@foreach($tasks as $task)
    @switch($task->status->name)
        @case($task->status->name === "Ожидается")
        <p>
            <button
                class="btn btn-warning w-100 collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control  bg-warning text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
        @case($task->status->name === "Принято")
        <p>
            <button
                class="btn btn-success w-100 collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control  bg-secondary text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
        @case($task->status->name === "Отклонено")
        <p>
            <button
                class="btn btn-danger w-100 collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control  bg-danger text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
        @case($task->status->name === "В процессе")
        <p>
            <button
                class="btn btn-primary w-100 collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control  bg-primary text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
        @case($task->status->name === "Просроченный")
        <p>
            <button
                class="btn btn-info w-100 collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control  bg-info text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
        @case($task->status->name === "На проверку")
        <p>
            <button
                class="btn btn-secondary w-100 collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control  bg-secondary text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
        @case($task->status->name === "Готов")
        <p>
            <button style="background-color: #00ff80"
                    class="btn btn-warning w-100 collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseExample{{ $task->id }}" aria-expanded="false"
                    aria-controls="collapseExample"><span
                    class="d-flex justify-content-start text-black"><i
                        class="bi bi-info-circle mx-2"></i> <span>{{ $task->name }}</span> </span>
            </button>
        </p>
        <div class="collapse my-3" id="collapseExample{{ $task->id }}">
            <div class="row p-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" class="form-control"
                               value="{{ $task->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user">Сотрудник</label>
                        <input type="text" id="user" class="form-control"
                               value="{{ $task->user->name }} {{ $task->user->surname }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->from)) }}" disabled>
                    </div>


                    @if($task->file !== null)
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <a href="#" download class="form-control text-bold">Просмотреть
                                файл</a>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="to">Файл</label>
                            <input type="text" class="form-control" id="to"
                                   value="Нет файл" disabled>
                        </div>
                    @endif
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="time">Время</label>
                        <input type="text" id="time" class="form-control"
                               value="{{$task->time}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="project">Проект</label>
                        <input type="text" id="project" class="form-control"
                               value="{{$task->project->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control"
                               value="{{ date('d-m-Y', strtotime($task->to)) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Коментария</label>
                        <textarea type="text" id="comment" class="form-control" disabled
                                  rows="1">{{ $task->comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sts">Статус</label>
                        <div class="form-group">
                            <input type="text" style="background-color: #00ff80"
                                   class="form-control  text-black"
                                   id="sts" value="{{ $task->status->name }}" disabled>
                        </div>


                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" id="type" class="form-control"
                                   value="{{ $task->type->name }} {{  (isset($task->typeType->name)) ? '- '.$task->typeType->name : '' }}"
                                   disabled>
                        </div>
                        <div class="form-group">
                            <label for="author">Автор</label>
                            <input type="text" id="author" class="form-control"
                                   value="{{ $task->author->name .' '. $task->author->surname}}"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4 ">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success w-100"><i class="bi bi-eye mx-2"></i>Просмотреть</a>
                </div>
                <div class="col-4">
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-pencil mx-2"></i>Изменить</a>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#delete{{ $task->id }}"><i class="bi bi-trash"></i>Удалить</button>
                </div>
            </div>
        </div>
        @break
    @endswitch
    <div class="modal fade" id="delete{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete{{ $task->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete{{ $task->id }}">Предупреждение</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Точно хотите удалть задачу?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                        <button type="submit" class="btn btn-primary">Да. точно</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
