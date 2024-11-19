<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекти</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Список проектів</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Додати проект
        </a>
    </div>

    <table class="table-auto w-full border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">Код</th>
            <th class="border border-gray-300 px-4 py-2">Автор</th>
            <th class="border border-gray-300 px-4 py-2">Бюджет</th>
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
                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 mr-2">Редагувати</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
