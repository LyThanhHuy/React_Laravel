<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = $this->admins();

        foreach ($admins as $item) {
            if (Admin::where('email', $item['email'])->first() == false) {
                Admin::create($item);
            }
        }
    }

    public function admins()
    {
        return [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        ];
    }
}
