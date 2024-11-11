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

<h1>Проекти</h1>
<table border="1">
    <tr>
        <th>Код</th><th>Автор</th><th>Кошторис</th><th>Оцінки</th><th>Дії</th>
    </tr>
    @foreach ($projects as $project)
        <tr>
            <td>{{ $project->code }}</td>
            <td>{{ $project->author }}</td>
            <td>{{ $project->budget }}</td>
            <td>{{ $project->rating1 }}, {{ $project->rating2 }}, {{ $project->rating3 }}</td>
            <td>
                <a href="{{ route('projects.edit', $project->id) }}">Редагувати</a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Видалити</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<form method="GET" action="{{ route('projects.index') }}">
    <label>Максимальний бюджет: <input type="number" name="max_budget" value="{{ request('max_budget') }}"></label>
    <label>Мінімальна сума рейтингу: <input type="number" name="min_rating_sum" value="{{ request('min_rating_sum') }}"></label>
    <button type="submit">Фільтрувати</button>
</form>


