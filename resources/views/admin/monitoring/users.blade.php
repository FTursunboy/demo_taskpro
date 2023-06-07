<div class="form-group">
    <label for="user_id">Сотрудник</label>
    <select name="user_id" id="user_id" class="form-select">
        <option value="0" selected>Все сотрудники</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->surname .' ' . $user->name .' '.$user->lastname }}</option>
        @endforeach
    </select>
</div>
