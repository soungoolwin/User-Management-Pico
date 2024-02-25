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
    @if (session('error'))
        <div id="errorMessage" class="alert alert-success text-center bg-red-300 text-white">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('errorMessage').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <div class="w-[50%] mx-auto my-8">
        <div class="flex row flex-row-reverse mb-6">

            @can('has-permission', 5)
                <a href="{{ route('roles.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create Role</a>
            @endcan
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
                                    <summary class="m-1 btn border p-2 rounded-lg cursor-pointer">Actions</summary>


                                    <ul class="p-2 shadow menu dropdown-content z-[1] rounded-lg">

                                        @can('has-permission', 7)
                                            <li><a href="{{ route('roles.edit', $role->id) }}">Edit</a></li>
                                        @elsecan('has-permission', 8)
                                            <li>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form></a>
                                            </li>
                                        @else
                                            <li>
                                                <p>No Actions Allowed</p>
                                            </li>
                                        @endcan
                                    </ul>

                                </details>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-layout>
