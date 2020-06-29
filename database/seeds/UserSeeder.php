<?php

use Illuminate\Database\Seeder;
use App\Models\RoleManagement\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'   => 'admin',
            'email'      => 'admin@mail.com',
            'photo'      => 'photo_048619b9-db3a-43d4-8492-2eca8d9ae068_1592899942.jpg',
            'password'   => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
