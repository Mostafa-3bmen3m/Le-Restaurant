<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::with('category')->latest()->paginate(10);

        return view('admin.meals.index', compact('meals'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.meals.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('meals', 'public');
            $validated['image'] = $path;
        }

        Meal::create($validated);

        return redirect()->route('admin.meals.index')->with('success', 'Meal created successfully.');
    }

    public function show(Meal $meal)
    {
        //
    }

    public function edit(Meal $meal)
    {
        $categories = Category::all();

        return view('admin.meals.edit', compact('meal', 'categories'));
    }

    public function update(Request $request, Meal $meal)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($meal->image) {
                Storage::disk('public')->delete($meal->image);
            }

            $path = $request->file('image')->store('meals', 'public');
            $validated['image'] = $path;
        }

        $meal->update($validated);

        return redirect()->route('admin.meals.index')->with('success', 'Meal updated successfully.');
    }

    public function destroy(Meal $meal)
    {
        if ($meal->image) {
            Storage::disk('public')->delete($meal->image);
        }

        $meal->delete();

        return redirect()->route('admin.meals.index')->with('success', 'Meal deleted successfully.');
    }
}
