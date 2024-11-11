@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>Додати новий проект</h2>
<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <label>Код проекту: <input type="text" name="code" value="{{ old('code') }}"></label><br>
    <label>Автор: <input type="text" name="author" value="{{ old('author') }}"></label><br>
    <label>Кошторис: <input type="number" name="budget" value="{{ old('budget') }}"></label><br>
    <label>Рейтинг 1: <input type="number" name="rating1" min="1" max="5" value="{{ old('rating1') }}"></label><br>
    <label>Рейтинг 2: <input type="number" name="rating2" min="1" max="5" value="{{ old('rating2') }}"></label><br>
    <label>Рейтинг 3: <input type="number" name="rating3" min="1" max="5" value="{{ old('rating3') }}"></label><br>
    <button type="submit">Додати проект</button>
</form>
<a href="{{ route('projects.index') }}">Назад до списку проектів</a>

