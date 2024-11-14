@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <div class="py-8">
        <div class="flex">
            <div>
                @isset($categories)
                    @foreach($categories as $category)
                        @if($category->id == $note->category_id)
                            <div class=" text-gray-600 grid"  >
                                <div class="ml-4 self-start">
                                <a class="hover:text-black" href="#"><h3>{{$category->title}}</a> > <a class="hover:text-black" href="#">{{$note->title}}</h3></a>
                                </div>
                                <div class="ml-96 justify-self-end">
                                    {{$note->created_at->format('d.m.Y H:i')}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endisset
                    <div class="justify-self-end">
                        @can('update',$note)
                            <a class="m-3 font-semibold w-20" href="{{route('notes.edit', ['id' => $note->id])}}">Редактировать</a>
                        @endcan
                        @can('delete', $note)
                            <button onclick="confirmDelete({{$note->id}})"  class=" text-red-600 m-3 w-20 font-semibold " >Удалить</button>
                        @endcan
                    </div>
            <div class=" p-3 max-w-5xl  sm:pr-4 lg:pr-8 text-lg justify-self-start">

                <h1 class="text-2xl m-4 font-bold text-blue-800">{{$note->user->name}}</h1>
                <h1 class="m-4 font-bold text-3xl">{{$note->title}}</h1>
                <p class="mt-14 ml-4 text-xl">{{$note->content}}</p>
            </div>
            <div class="relative bottom-8 ml-auto w-96 text-gray-600 dark:text-black">
                <div class>


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
        <h1 class="text-3xl p-5 font-semibold">Комментарии</h1>
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
                        <h1 class="text-xl font-semibold border-b border-gray-500">{{$comment->user->name}}</h1>
                    </div>
                    <div class="m-3">
                        <p>{{$comment->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
