<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:pr-4 lg:pr-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <form method="GET" action="{{ route('notes.search') }}">
                        @csrf
                        <input class="w-full rounded border-gray-300" name="query" placeholder="Что вы хотите найти?">
                    </form>
                </div>

                @isset($notes)
                    @foreach($notes as $note)
                        <div class="h-54 m-2 border border-gray-400 rounded p-2 bg-gray-100 dark:bg-indigo-800 dark:text-stone-950">
                            <div class="max-h-48 overflow-hidden"> <!-- Обеспечиваем скролл для текста -->
                                <div
                                    <h3>{{ $note->created_at->format('d.m.Y H:i') }}</h3>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold">
                                        <a href="{{ route('notes.show', ['id' => $note->id ]) }}">{{ $note->title }}</a>
                                    </h1>
                                </div>
                                <div class="max-h-32 mt-3 break-words max-w-7xl overflow-hidden">
                                    <pre class="whitespace-pre-wrap text-lg">{{ $note->content }}</pre>
                                </div>
                            </div>

                            <!-- Категория рендерится вне ограниченного по высоте блока -->
                            @isset($categories)
                                @foreach($categories as $category)
                                    @if($category->id == $note->category_id)
                                        <div class="max-w-fit p-1 text-gray-500 font-semibold bg-gray-200 dark:bg-indigo-700 rounded">
                                            {{ $category->title }}
                                        </div>
                                    @endif
                                @endforeach
                            @endisset
                        </div>
                    @endforeach
                @endisset

                @if(count($notes) < 1)
                    <p class="mt-24 ml-6 text-2xl text-gray-400">У вас нет заметок</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
