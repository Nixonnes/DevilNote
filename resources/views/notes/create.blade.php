<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Новая заметка') }}
        </h2>
    </x-slot>

    <x-slot name="sidebar">
        <div class="p-3 mt-48 font-semibold text-lg">
            <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg active:bg-gray-500">
                <a href="#">Мои заметки</a>
            </div>
            <div class="flex justify-center w-full p-4 hover:bg-amber-900 rounded-lg active:bg-gray-500">
                <a href="#">Сообщества</a>
            </div>

        </div>
    </x-slot>
    <div class="m-4 rounded-lg min-h-svh border border-gray-300  ">
        <div class="mt-24 ">
            <form method="POST" action="{{route('notes.store')}}">
                @csrf
                <div>
                    <input class=" ml-52  w-4/6 p-6 border-none text-3xl bg-gray-100  font-semibold shadow-none focus:ring-0 overflow-hidden " placeholder="Заголовок поста" name="title"/>
                </div>
                <div>
                    <textarea class="ml-52 w-4/6 p-6 resize-none min-h-96 h-fit border-none shadow-none bg-gray-100 focus:ring-0 text-lg text-wrap" placeholder="О чем вы хотите написать?" name="content"></textarea>
                </div>

                <div class="mt-4 ml-52">
                    <x-primary-button >Сохранить</x-primary-button>
                </div>

            </form>

    </div>


</x-app-layout>
