<div class="form-group">
    <label for="project_id">Проекты</label>
    <select name="project_id" id="project_id" class="form-select">
        <option value="0" selected>Все проекты</option>
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
</div>
