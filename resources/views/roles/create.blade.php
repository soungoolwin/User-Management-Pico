<x-layout>
    <form method="POST" action="{{ route('roles.store') }}">
        @csrf

        <div class="flex my-3">
            <label for="role_name" class="block mr-3">Role Name</label>
            <input type="text" name="role_name" id="role_name" class="form-input">
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Select All
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        View
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Create
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Update
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($features as $feature)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $feature->name }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="select-all rounded h-4 w-4 text-blue-600">
                        </td>

                        @foreach ($feature->permissions as $permission)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    class="action-checkbox rounded h-4 w-4 text-blue-600">
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create Role
        </button>
    </form>


</x-layout>

<script>
    const selectAllCheckboxes = document.querySelectorAll('.select-all');
    selectAllCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
            const row = checkbox.closest('tr');
            const actionCheckboxes = row.querySelectorAll('.action-checkbox');
            actionCheckboxes.forEach(function(actionCheckbox) {
                actionCheckbox.checked = checkbox.checked;
            });
        });
    });
</script>
