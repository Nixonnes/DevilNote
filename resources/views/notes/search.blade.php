<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Результаты поиска') }}
        </h2>
    </x-slot>
    <form method="GET" action="{{route('notes.search')}}">
        @csrf
        <input class="w-full rounded border-gray-300" name="query" placeholder="Что вы хотите найти?">
    </form>
<h2 class="text-2xl p-5 font-bold">Результаты поиска по запросу : "{{$query}}"</h2>
@if($notes->isEmpty())
    <p>Заметки не найдены.</p>
@else
        @foreach($notes as $note)
            <div class=" h-52 overflow-hidden m-2 border border-gray-300 rounded-lg p-6 bg-gray-100 dark:bg-indigo-800 dark:text-stone-950">
                <div>
                    <h3>{{$note->created_at->format('d.m.Y H:i')}}</h3>
                </div>
                <div class>
                    <h1 class="text-3xl font-bold"><a href="{{route('notes.show', ['id' => $note->id ])}}">{{$note->title}}</a></h1>
                </div>
                <div class="mt-3 break-words max-w-7xl ">
                    <pre class="whitespace-pre-wrap text-lg">{{$note->content}}</pre>
                </div>
                @isset($categories)
                    @foreach($categories as $category)
                        @if($category->id == $note->category_id)
                            <div class="border rounded-lg border-black max-w-fit m-5 p-1 bg-amber-600 font-semibold">
                                {{$category->title}}
                            </div>
                        @endif

                    @endforeach

                @endisset
            </div>
                @endforeach
                @endif


</x-app-layout>
