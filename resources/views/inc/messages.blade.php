@if($errors->any())
    <div class="alert alert-danger mt-2">
        <ol>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif

@if(\Session::has('create'))
    <div class="alert alert-success" id="create">
        {{ \Session::get('create') }}
    </div>
    <script>
        setTimeout(() => {
            $('#create').remove()
        },4500)
    </script>
@elseif(\Session::has('update'))
    <div class="alert alert-info" id="update">
        {{ \Session::get('update') }}
    </div>
    <script>
        setTimeout(() => {
            $('#update').remove()
        },4500)
    </script>
@elseif(\Session::has('delete'))
    <div class="alert alert-danger" id="delete">
        {{ \Session::get('delete') }}
    </div>
    <script>
        setTimeout(() => {
            $('#delete').remove()
        },4500)
    </script>
@elseif(\Session::has('error'))
    <div class="alert alert-danger" id="error">
        {{ \Session::get('error') }}
    </div>
    <script>
        setTimeout(() => {
            $('#error').remove()
        },4500)
    </script>
@elseif(\Session::has('warning'))
    <div class="alert alert-warning" id="warning">
        {{ \Session::get('warning') }}
    </div>
    <script>
        setTimeout(() => {
            $('#warning').remove()
        },4500)
    </script>
@endif
