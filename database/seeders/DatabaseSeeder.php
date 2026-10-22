<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $categories = [
            ['name' => 'Appetizers', 'slug' => 'appetizers'],
            ['name' => 'Main Courses', 'slug' => 'main-courses'],
            ['name' => 'Desserts', 'slug' => 'desserts'],
            ['name' => 'Drinks', 'slug' => 'drinks'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
        
        $appetizers = Category::where('slug', 'appetizers')->first();
        $mains = Category::where('slug', 'main-courses')->first();
        $desserts = Category::where('slug', 'desserts')->first();

        Meal::create([
            'category_id' => $appetizers->id,
            'name' => 'Bruschetta',
            'description' => 'Grilled bread rubbed with garlic and topped with olive oil and salt.',
            'price' => 8.50,
            'image' => 'meals/bruschetta.jpg',
        ]);

        Meal::create([
            'category_id' => $mains->id,
            'name' => 'Grilled Salmon',
            'description' => 'Atlantic salmon fillet grilled to perfection with lemon butter sauce.',
            'price' => 22.00,
            'image' => 'meals/salmon.jpg',
        ]);

        Meal::create([
            'category_id' => $mains->id,
            'name' => 'Steak Frites',
            'description' => 'Juicy ribeye steak served with crispy french fries.',
            'price' => 28.00,
            'image' => 'meals/steak.jpg',
        ]);

        Meal::create([
            'category_id' => $desserts->id,
            'name' => 'Tiramisu',
            'description' => 'Classic Italian dessert made with ladyfingers, coffee, and mascarpone cheese.',
            'price' => 9.00,
            'image' => 'meals/tiramisu.jpg',
        ]);
    }
}
