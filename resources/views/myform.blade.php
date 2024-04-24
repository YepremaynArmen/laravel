{{-- resources/views/myform.blade.php --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('myform.submit') }}">
    @csrf
    <label for="my_field">My Field:</label>
    <input type="text" id="my_field" name="my_field" value="{{ old('my_field') }}" required>
    <button type="submit">Отправить</button>
</form>