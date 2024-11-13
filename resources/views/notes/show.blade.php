@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-black">
            {{ $note->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-slot name="sidebar">
            <div class="p-3 mt-48 font-semibold text-lg">
                <div class="flex justify-center p-4 w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="{{route('notes.create')}}">Новая заметка</a>
                </div>
                <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="#">Мои заметки</a>
                </div>
                <div class="flex justify-center w-full p-4 hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="#">Сообщества</a>
                </div>
                <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                    <a href="#">Категории</a>
                </div>

            </div>
        </x-slot>
        <div class="flex">
            <div class=" p-5 max-w-4xl  sm:pr-4 lg:pr-8 text-lg justify-self-start">
                <h1 class="text-4xl font-bold">{{$note->user->name}}</h1>
                <p class="mt-14">{{$note->content}}</p>
            </div>
            <div class="relative bottom-8 ml-auto w-96 text-gray-600 dark:text-black">
                <div class>
                    <div class="ml-56">
                        {{$note->created_at->format('d.m.Y H:i')}}
                    </div>
                    <div>
                        @can('update',$note)
                        <a class="m-2" href="{{route('notes.edit', ['id' => $note->id])}}">Редактировать</a>
                        @endcan
                        @can('delete', $note)
                        <button onclick="confirmDelete({{$note->id}})"  class=" text-red-600 w-36 " >Удалить</button>
                        @endcan
                    </div>

                </div>
{{--  Модальное окно для  подтверждения удаления заметки  --}}
                <div id="deleteNote" class = "fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50">
                    <div class="bg-white p-5 rounded shadow-lg">
                        <h2>Вы действительно хотите удалить заметку?</h2>
                        <div class="mt-4">
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Удалить</button>


                                <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>'
    </div>
    {{--   Like Button--}}
    <div>
        <form action="{{route('like.note', ['id' => $note->id])}}">
            <x-primary-button type="button" data-note-id="{{$note->id}}" id="like-btn" class="m-5 {{$isLiked ? 'liked' : ''}}">Мне нравится <pre>  </pre>
                <span id="like-count"> {{ $note->likes->count() }} </span>
                </x-primary-button>
            <span class="like-count"></span>
        </form>

    </div>
    {{--            Comment Section--}}
    <div class="mt-6">
        <h1 class="text-4xl p-5 font-semibold">Комментарии</h1>
        <div>
            <form action="{{route('comments.store', ['id' => $note->id])}}" method="POST">
                @csrf
                <textarea class=" m-3 p-4 w-5/6 rounded resize-none max-h-96" name="content" placeholder=""></textarea>
                <div class="m-3">
                    <x-primary-button type="submit">Отправить</x-primary-button>
                </div>

            </form>
        </div>
        <div>
            @foreach($comments as $comment)
                <div>
                    <div class="m-3">
                        <h1 class="text-xl font-semibold">{{$comment->user->name}}</h1>
                    </div>
                    <div class="m-3">
                        <p>{{$comment->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
