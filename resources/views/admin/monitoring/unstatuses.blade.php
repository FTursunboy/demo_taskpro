<div class="form-group">
    <label for="unstatus_id">Статус</label>
    <select name="unstatus_id" id="unstatus_id" class="form-select">
        <option value="0" selected>Все</option>
        @foreach($statuses as $status)
            <option value="{{ $status->id }}">{{ $status->name }}</option>
        @endforeach
    </select>
</div>
