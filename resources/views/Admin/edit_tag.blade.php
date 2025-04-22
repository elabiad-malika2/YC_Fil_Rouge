<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le tag - E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Modifier le tag
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom du tag</label>
                        <input type="text" name="name" id="name" value="{{ $tag->name }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="color" class="block text-sm font-medium text-gray-700">Couleur du tag</label>
                        <input type="color" name="color" id="color" value="{{ $tag->color }}" required class="mt-1 block w-full h-10">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('tags.index') }}" class="text-indigo-600 hover:text-indigo-500">
                        Retour
                    </a>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 