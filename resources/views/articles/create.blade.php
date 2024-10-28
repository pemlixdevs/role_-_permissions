<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles Create') }}
            </h2>
            <a href="{{ route('articles.index') }}"
                class="bg-slate-700 hover:bg-slate-800 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('articles.store') }}" method="post">
                        @csrf
                        <label for="" class="text-lg font-medium">Title</label>
                        <div class="my-3">
                            <input type="text" name="title" placeholder="Enter Title" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('title')
                                 <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="" class="text-lg font-medium">Content</label>
                        <div class="my-3">
                            <textarea name="text" id="text" cols="30" rows="5"  placeholder="Enter Text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"></textarea>
                            @error('text')
                                 <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <label for="" class="text-lg font-medium">Author</label>
                        <div class="my-3">
                            <input type="text" name="author" placeholder="Enter Author" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('author')
                                 <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <button class="bg-slate-700 hover:bg-slate-800 text-sm rounded-md text-white px-5 py-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
