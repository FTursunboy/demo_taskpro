<div class="form-group">
    <label for="status_id">Статус</label>
    <select name="status_id" id="status_id" class="form-select">
        <option value="0" selected>Все</option>
        @foreach($statuses as $status)
            <option value="{{ $status->id }}">{{ $status->name }}</option>
        @endforeach
    </select>
</div>
