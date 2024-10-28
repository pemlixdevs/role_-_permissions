<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('create users')


            <a href="{{ route('users.create') }}"
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
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Email</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Roles</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Created At</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td class="px-4 py-2 text-gray-700">{{ $user->index + 1 }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $user->id }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $user->email}}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td class="px-4 py-2 text-gray-700">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                                </td>
                                <td class="px-4 py-2 text-gray-700">
                                    <!-- Actions -->
                                    @can('edit users')

                                    <a href="{{ route('users.edit',$user->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
                                    @endcan
                                   <a href="javascript:void(0);" onclick="deleteUser('{{ $user->id }}')" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="my-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <x-slot name='script'>
        <script type="text/javascript">
        function deleteUser(id){
            if(confirm("Are you sure you want to delete?")){
                $.ajax({
                    url:'{{ route('users.destroy') }}',
                    type: 'delete',
                    data: {id:id},
                    dataType:'json',
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response){
                        window.location.href = '{{ route('users.index') }}'
                    }
                })
            }
        }
        </script>
    </x-slot>
</x-app-layout>
