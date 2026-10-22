<x-admin-layout>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Add Meal</h1>
            <p class="mt-2 text-sm text-gray-700">Create a new meal listing.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('admin.meals.index') }}" class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Back to List</a>
        </div>
    </div>

    <div class="mt-8 max-w-2xl">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.meals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                            <div class="mt-2">
                                <select id="category_id" name="category_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price ($)</label>
                            <div class="mt-2">
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <div class="mt-2">
                                <textarea id="description" name="description" rows="3" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full" x-data="imagePreview()">
                            <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center relative">
                                     <!-- Placeholder or Preview -->
                                    <template x-if="!imageUrl">
                                        <svg class="h-10 w-10 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                        </svg>
                                    </template>
                                    <template x-if="imageUrl">
                                        <img :src="imageUrl" class="h-full w-full object-cover" x-ref="previewImage">
                                    </template>
                                </div>
                                <input type="file" name="image" id="image" @change="fileChosen" accept="image/*" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" onclick="window.location='{{ route('admin.meals.index') }}'" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function imagePreview() {
            return {
                imageUrl: null,

                fileChosen(event) {
                    this.fileToDataUrl(event, src => {
                        this.imageUrl = src;
                        this.$nextTick(() => {
                           if (this.$refs.previewImage && window.gsap) {
                               gsap.fromTo(this.$refs.previewImage, 
                                   { opacity: 0, scale: 0.8, rotate: -10 }, 
                                   { opacity: 1, scale: 1, rotate: 0, duration: 0.5, ease: "back.out(1.7)" }
                               );
                           }
                        });
                    });
                },

                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return;

                    let file = event.target.files[0];
                    let reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = e => callback(e.target.result);
                },
            }
        }
    </script>
</x-admin-layout>
