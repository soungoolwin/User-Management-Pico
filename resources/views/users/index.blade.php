<x-layout>
    @if (session('success'))
        <div id="successMessage" class="alert alert-success text-center bg-green-300 text-white">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 3000);
        </script>
    @endif
    <div class="w-[50%] mx-auto my-8">
        <div class="flex my-3 justify-between">
            <div>
                <label for="role_name" class="block mr-3">Search User</label>
                <input type="text" name="role_name" id="role_name" class="form-input">
            </div>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="relative">
                                <details class="dropdown w-[50%] mx-auto">
                                    <summary class="m-1 btn border p-2 rounded-lg">Actions</summary>
                                    <ul class="p-2 shadow menu dropdown-content z-[1] rounded-lg">
                                        <li><a href="/home">Edit</a></li>
                                        <li>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form></a>
                                        </li>
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
