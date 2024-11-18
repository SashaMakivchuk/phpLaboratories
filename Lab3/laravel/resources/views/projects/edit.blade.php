<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати проект</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<div class="max-w-4xl mx-auto p-6">
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

    <h2 class="text-xl font-bold mb-6">Редагувати проект: {{ $project->code }}</h2>
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="code" class="block font-medium">Код проекту</label>
                <input type="text" id="code" name="code" value="{{ old('code', $project->code) }}" class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="author" class="block font-medium">Автор</label>
                <input type="text" id="author" name="author" value="{{ old('author', $project->author) }}" class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="budget" class="block font-medium">Кошторис</label>
                <input type="number" id="budget" name="budget" value="{{ old('budget', $project->budget) }}" class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="rating1" class="block font-medium">Рейтинг 1</label>
                <input type="number" id="rating1" name="rating1" min="1" max="10" value="{{ old('rating1', $project->rating1) }}" class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="rating2" class="block font-medium">Рейтинг 2</label>
                <input type="number" id="rating2" name="rating2" min="1" max="10" value="{{ old('rating2', $project->rating2) }}" class="w-full p-2 border rounded">
            </div>
            <div>
                <label for="rating3" class="block font-medium">Рейтинг 3</label>
                <input type="number" id="rating3" name="rating3" min="1" max="10" value="{{ old('rating3', $project->rating3) }}" class="w-full p-2 border rounded">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Оновити проект</button>
            <a href="{{ route('projects.index') }}" class="bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-400 ml-2">Назад</a>
        </div>
    </form>
</div>
</body>
</html>
