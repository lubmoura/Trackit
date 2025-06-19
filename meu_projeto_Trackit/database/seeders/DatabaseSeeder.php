<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        Model::create([
            'name' => 'Nome', //string
            'idade' => 18, //numeros
            'password' => bcrypt('12345678'), //senhas de preferencia criptografadas
        ]);
        */

        User::updateOrCreate(
            ['email' => 'adm@gmail.com'], 
            [                             
                'name' => 'Adm',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'chris@gmail.com'],
            [
                'name' => 'Chris',
                'password' => bcrypt('chris123'),
                'is_admin' => false,
            ]
        );
    }
}
