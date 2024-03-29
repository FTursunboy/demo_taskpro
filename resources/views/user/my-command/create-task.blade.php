<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary my-4" data-bs-toggle="modal" data-bs-target="#create-task">
    Создать задачу
</button>

<a href="{{ route('my-command.taskInQuery')}}" class="btn btn-outline-warning">Мои отправленные задачи</a>

<!-- Modal -->
<div class="modal fade" id="create-task" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="create-task" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create-task">Создать задачу</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('my-command.createTaskInCommand') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input tabindex="1" type="text" id="name" name="name" class="form-control mt-3"
                                           placeholder="Имя" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_id">Кому это задача</label>
                                    <select tabindex="4" id="user_id" name="user_id" class="form-select mt-3">
                                        <option value="" selected>Выберите сотрудника</option>
                                        @foreach($myCommand as $command)
                                                <option value="{{ $command->id }}">{{ $command->surname . ' ' . $command->name . ' ' . $command->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="from">Дата начала задачи</label>
                                    <input disabled tabindex="7" type="date" id="from" name="from" class="form-control mt-3"
                                           value="{{ old('from') }}" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="time">Время</label>
                                    <input tabindex="2" type="number" id="time" name="time" class="form-control mt-3"
                                           value="{{ old('time') }}" placeholder="Время"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="project_id">Проект</label>
                                    <select  tabindex="5" id="project_id" name="project_id" class="form-select mt-3">
                                        <option value="" selected disabled>Выберите проект</option>
                                        @foreach($myProject as $project)
                                            <option value="{{ $project->project_id }}" class="{{ date('Y-m-d', strtotime($project->finish)) }}" {{ ($project->project_id === old('project_id')) ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="to">Дата окончания задачи  <span  id="project_finish" style="color: red"></span> </label>
                                    <input disabled tabindex="8" type="date" id="to" name="to" class="form-control mt-3" value="{{ old('to') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="type_id">Тип</label>
                                    <select tabindex="3" id="type_id" name="type_id" class="form-select mt-3">
                                        <option value="" tabindex="3" selected>Выберите тип</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Комментарие</label>
                                    <textarea tabindex="10" name="comment" id="comment" rows="4"
                                              class="form-control mt-3">{{ old('comment') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="file">Файл</label>
                                    <input tabindex="11" type="file"  name="file" class="form-control mt-3" id="file">
                                </div>
                            </div>
                            <div class="col-6"></div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
