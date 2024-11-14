<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактирование заметки') }}
        </h2>
    </x-slot>
    <div class="m-4  min-h-svh border border-gray-300 p-1 rounded-lg">
        <div class="h-svh ">
            <form class="min-h-full" method="POST" action="{{route('notes.update', [
    'id' => $note->id
])}}">
                @method('PATCH')
                @csrf

                <div>
                    <input class="w-full p-6 border-none text-3xl bg-gray-100  font-semibold shadow-none focus:ring-0 overflow-hidden dark:bg-black dark:text-white " placeholder="Заголовок поста" name="title" value="{{$note->title}}"/>
                </div>
                <div>
                    <textarea class="content  w-full p-6 resize-none  border-none shadow-none bg-gray-100 focus:ring-0 text-lg text-wrap dark:bg-black dark:text-white" placeholder="О чем вы хотите написать?" name="content">{{$note->content}}</textarea>
                </div>

                <div class="mt-4">
                    <x-primary-button >Сохранить</x-primary-button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>

