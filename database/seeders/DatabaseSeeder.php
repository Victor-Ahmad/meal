<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountryStateCityTableSeeder::class);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'type' => 'admin',
            'phone_number' => '111111111',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('qwe123as'),
        ])->assignRole($admin);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'type' => 'dashboard_user',
            'phone_number' => '222222222',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('qwe123as'),
        ])->assignRole($user);

        \App\Models\User::factory()->create([
            'name' => 'Test Driver',
            'type' => 'driver',
            'phone_number' => '333333333',
            'email' => 'testdriver@gmail.com',
            'password' => bcrypt('qwe123as'),
        ])->assignRole($user);


        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(OffersTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
    }
}
