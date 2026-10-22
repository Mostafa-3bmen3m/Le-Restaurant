<x-admin-layout>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Meals</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all meals including their image, name, price, and category.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('admin.meals.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Meal</a>
        </div>
    </div>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mt-4 p-4 rounded-md bg-green-50 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Image</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($meals as $meal)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}">
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">{{ $meal->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $meal->category->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${{ $meal->price }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="{{ route('admin.meals.edit', $meal) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                        <form action="{{ route('admin.meals.destroy', $meal) }}" method="POST" class="inline-block" x-data @submit.prevent="if(confirm('Are you sure?')) $el.submit()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $meals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
