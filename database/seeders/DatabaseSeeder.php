<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleSeeder::class
        ]);

        $products = Product::factory(30)->create();

        User::factory(25)->create()->each(function ($user) use ($products) {
            $userRoleId = Role::get()->random(1)->pluck('id');
            $user->assignRole($userRoleId);
            Order::factory(rand(1, 4))->create([
                'user_id' => $user->id
            ])->each(function ($order) use ($products){
                $product = $products->random(rand(2,5));
                $order->product()->attach($product);
            });
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
