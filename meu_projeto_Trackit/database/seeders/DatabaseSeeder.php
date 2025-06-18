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

        User::create([
            'name' => 'Adm',
            'email' => 'adm@gmail.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        
    }
}
