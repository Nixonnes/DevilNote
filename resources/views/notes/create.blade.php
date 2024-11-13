<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Новая заметка') }}
        </h2>
    </x-slot>

    <x-slot name="sidebar">
        <div class="p-3 mt-48 font-semibold text-lg">
            <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg active:bg-gray-500">
                <a href="{{route('user.notes', ['user_id' => auth()->user()->getAuthIdentifier()] )}}">Мои заметки</a>
            </div>
            <div class="flex justify-center w-full p-4 hover:bg-amber-900 rounded-lg active:bg-gray-500">
                <a href="#">Сообщества</a>
            </div>
            <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                <a href="#">Категории</a>
            </div>
        </div>
    </x-slot>
    <div class="m-4  min-h-svh border border-gray-300 p-1 rounded-lg">
        <div class="h-svh ">
            <form class="min-h-full" method="POST" action="{{route('notes.store')}}">
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div>
                    <input class="w-full p-6 border-none text-3xl bg-gray-100  font-semibold shadow-none focus:ring-0 overflow-hidden dark:bg-black dark:text-white " placeholder="Заголовок поста" name="title" value="{{old('title')}}"/>
                </div>
                <div>
                    <textarea class="content  w-full p-6 resize-none  border-none shadow-none bg-gray-100 focus:ring-0 text-lg text-wrap dark:bg-black dark:text-white" placeholder="О чем вы хотите написать?" name="content">{{old('content')}}</textarea>
                </div>
                    <div>
                        @if($categories)
                            <div x-data="{ showExistingCategories: false, showNewCategoryInput: false }">
                                <button type="button" @click="showExistingCategories = true; showNewCategoryInput = false">Выбрать существующую категорию</button>
                                <button type="button" @click="showExistingCategories = false; showNewCategoryInput = true">Создать новую категорию</button>

                                <!-- Список существующих категорий -->
                                <div x-show="showExistingCategories" style="display: none;">
                                    <select name="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Поле для новой категории -->
                                <input type="text" x-show="showNewCategoryInput" name="new_category" style="display: none;" placeholder="Введите новую категорию">
                            </div>

                        @endif
                <div class="mt-4">
                    <x-primary-button >Сохранить</x-primary-button>
                </div>
                    </div>
            </form>

    </div>
    </div>

</x-app-layout>
