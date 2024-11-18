<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекти</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<div class="max-w-7xl mx-auto p-4">
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Проекти</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Додати новий проект
        </a>
    </div>

    <table class="table-auto border-collapse w-full border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">Код</th>
            <th class="border border-gray-300 px-4 py-2">Автор</th>
            <th class="border border-gray-300 px-4 py-2">Кошторис</th>
            <th class="border border-gray-300 px-4 py-2">Оцінки</th>
            <th class="border border-gray-300 px-4 py-2">Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-2">{{ $project->code }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $project->author }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $project->budget }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    {{ $project->rating1 }}, {{ $project->rating2 }}, {{ $project->rating3 }}
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 hover:underline">Редагувати</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form method="GET" action="{{ route('projects.index') }}" class="mt-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="max_budget" class="block text-sm font-medium">Максимальний бюджет</label>
                <input type="number" id="max_budget" name="max_budget" value="{{ request('max_budget') }}" class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="min_rating_sum" class="block text-sm font-medium">Мінімальна сума рейтингу</label>
                <input type="number" id="min_rating_sum" name="min_rating_sum" value="{{ request('min_rating_sum') }}" class="w-full p-2 border rounded">
            </div>
        </div>
        <button type="submit" class="mt-4 bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Фільтрувати</button>
    </form>
</div>
</body>
</html>


