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
        <div class="flex justify-between mb-6">
            <input class="w-64 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                placeholder="Search" />
            <a href="{{ route('roles.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create Role</a>
        </div>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-center">No</th>
                    <th class="px-4 py-2 text-center">ROLE</th>
                    <th class="px-4 py-2 text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-center">{{ $role->name }}</td>
                        <td class="px-4 py-2 text-center">
                            <div class="relative">
                                <details class="dropdown w-[50%] mx-auto">
                                    <summary class="m-1 btn border p-2 rounded-lg">Actions</summary>
                                    <ul class="p-2 shadow menu dropdown-content z-[1] rounded-lg">
                                        <li><a href="{{ route('roles.edit', $role->id) }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form></a>
                                        </li>
                                    </ul>
                                </details>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="flex justify-between items-center mt-6">
            <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                <option value="10">10</option>
                <option value="5">5</option>
                <option value="20">20</option>
            </select>
            <div class="flex items-center space-x-1">
                <button
                    class="px-3 py-2 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">&lt;</button>
                <button
                    class="px-3 py-2 text-blue-500 border border-blue-500 rounded-md hover:bg-blue-100 focus:outline-none focus:bg-blue-100">1</button>
                <button
                    class="px-3 py-2 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">2</button>
                <button
                    class="px-3 py-2 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">&gt;</button>
            </div>
        </div>
    </div>


</x-layout>
