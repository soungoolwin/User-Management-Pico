<x-layout>
    <x-successMessage />
    <x-errorMessage />
    <div class="w-[50%] mx-auto my-8">
        <div class="flex my-3 row flex-row-reverse">
            <div>
                <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create</a>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        User
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Username
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2 text-center">
                            <div class="relative">
                                <details class="dropdown w-[50%] mx-auto">

                                    <summary class="m-1 btn border pr-2 py-2 rounded-lg cursor-pointer">Actions
                                    </summary>
                                    <ul class="p-2 shadow menu dropdown-content z-[1] rounded-lg">
                                        @can('update', App\Models\User::class)
                                            <li><a href="{{ route('users.edit', $user->id) }}">Edit</a></li>
                                        @endcan
                                        @can('delete', App\Models\User::class)
                                            <li>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form></a>
                                            </li>
                                        @endcan

                                    </ul>

                                </details>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->username }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</x-layout>
