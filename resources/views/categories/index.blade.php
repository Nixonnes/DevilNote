<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:pr-4 lg:pr-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <form method="GET" action="{{ route('categories.search') }}">
                        @csrf
                        <input class="w-full rounded border-gray-300" name="query" placeholder="Поиск по категориям">
                    </form>
                    @isset($categories)
                        @foreach($categories as $category)
                            <div class="h-54 m-2 border border-gray-400 rounded p-2 bg-gray-100 dark:bg-indigo-800 dark:text-stone-950">
                                <div class="max-h-48 overflow-hidden"> <!-- Обеспечиваем скролл для текста -->
                                    @endforeach
                                    @endisset
                </div>
        </div>
    </div>
</x-app-layout>
