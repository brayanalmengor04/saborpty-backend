<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body class="bg-gray-100 font-sans">

    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-10">🌟 Categorías Disponibles 🌟</h1>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-4">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="rounded-md w-full h-48 object-cover mb-4">
                    <h2 class="text-xl font-bold text-gray-800">{{ $category->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $category->description ?? 'Sin descripción disponible.' }}</p>
                </div>
            @empty
                <p class="col-span-3 text-center text-red-500 text-lg">No hay categorías disponibles.</p>
            @endforelse
        </div>
    </div>

</body>
</html>