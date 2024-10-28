<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            @can('create articles')
            <a href="{{ route('articles.create') }}"
            class="bg-slate-700 hover:bg-slate-800 text-sm rounded-md text-white px-3 py-2">Create </a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Sn</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Id</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Title</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Content</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Author</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Created At</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($articles->isNotEmpty())
                        @foreach ($articles as $article)
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td class="px-4 py-2 text-gray-700">{{ $loop->index + 1 }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $article->id }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $article->title }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $article->text }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $article->author }}</td>
                                <td class="px-4 py-2 text-gray-700">
                                    {{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}
                                </td>
                                <td class="px-4 py-2 text-gray-700">
                                    <!-- Actions -->
                                    @can('edit articles')

                                    <a href="{{ route('articles.edit',$article->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
                                    @endcan
                                    @can('delete articles')
                                    <a href="javascript:void(0);" onclick="deleteArticle('{{ $article->id }}')" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Delete</a>
                                @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="my-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>

    <x-slot name='script'>
        <script type="text/javascript">
        function deleteArticle(id){
            if(confirm("Are you sure you want to delete?")){
                $.ajax({
                    url:'{{ route('articles.destroy') }}',
                    type: 'delete',
                    data: {id:id},
                    dataType:'json',
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response){
                        window.location.href = '{{ route('articles.index') }}'
                    }
                })
            }
        }
        </script>
    </x-slot>
</x-app-layout>
