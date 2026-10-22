<x-admin-layout>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Create Category</h1>
            <p class="mt-2 text-sm text-gray-700">Add a new category for meals.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Back to List</a>
        </div>
    </div>

    <div class="mt-8 max-w-xl">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" onclick="window.location='{{ route('admin.categories.index') }}'" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
