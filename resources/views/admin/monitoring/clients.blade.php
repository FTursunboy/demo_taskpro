<div class="form-group">
    <label for="client_id">Клиенты</label>
    <select name="client_id" id="client_id" class="form-select">
        <option value="0" selected>Все клиенты</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->surname. ' '.$client->name }}</option>
        @endforeach
    </select>
</div>
