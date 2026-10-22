<x-admin-layout>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg opacity-0" id="welcome-card">
        <div class="p-6 text-gray-900">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">Welcome back, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-600 mb-6">You are now logged into the secure admin area. Manage your categories and
                meals from the sidebar.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div
                    class="bg-indigo-50 p-6 rounded-lg border border-indigo-100 hover:shadow-md transition-shadow duration-300">
                    <h3 class="font-semibold text-indigo-700 text-lg">Quick Access</h3>
                    <div class="mt-4 flex gap-4">
                        <a href="{{ route('admin.categories.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700">
                            Add Category
                        </a>
                        <a href="{{ route('admin.meals.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 focus:bg-pink-700">
                            Add Meal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            if (window.gsap) {
                gsap.to("#welcome-card", { duration: 1, opacity: 1, y: 0, ease: "power3.out", startAt: { y: 20 } });
            } else {
                console.warn("GSAP not loaded");
                document.getElementById('welcome-card').style.opacity = 1;
            }
        });
    </script>
</x-admin-layout>