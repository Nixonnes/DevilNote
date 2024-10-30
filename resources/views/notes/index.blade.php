<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Главная') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-slot name="sidebar">
            <div class="p-3 mt-48 font-semibold text-lg">
                <div class="flex justify-center p-4 w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="notes/create">Новая заметка</a>
                </div>
                <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="#">Мои заметки</a>
                </div>
                <div class="flex justify-center w-full p-4 hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="#">Сообщества</a>
                </div>

            </div>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:pr-4 lg:pr-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                    @isset($notes)
                        @foreach($notes as $note)
                            <div class=" h-56 overflow-hidden m-6 border border-gray-300 rounded-lg p-6 bg-amber-500/35">
                                <div>
                                    <h3>{{$note->created_at}}</h3>
                                </div>
                                <div class>
                                    <h1 class="text-3xl font-bold"><a href="{{route('notes.show', ['id' => $note->id ])}}">{{$note->title}}</a></h1>
                                </div>
                                <div class="mt-3 break-words max-w-7xl ">
                                    <pre class="whitespace-pre-wrap">{{$note->content}}</pre>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
