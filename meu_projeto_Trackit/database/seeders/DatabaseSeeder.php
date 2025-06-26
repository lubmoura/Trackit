<?php

namespace Database\Seeders;

use App\Models\Url;
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

        $urls = [
            'https://i.ibb.co/KjyPvkhN/The-Last-Of-Us-part-2.jpg',
            'https://i.ibb.co/wxL3YFc/Zelda: Breath of the Wild.jpg',
            'https://i.ibb.co/DD0Z6b82/Grand Theft Auth V.jpg',
            'https://i.ibb.co/ZRP02KSG/The sims 4-2.jpg',
            'https://i.ibb.co/Pz6Ft0BK/Life is Strange-3.jpg',
            'https://i.ibb.co/35vctLBw/Skyrim-4.jpg',
            'https://i.ibb.co/Y73cTsgX/FireWatch-5.jpg',
            'https://i.ibb.co/6RH21vp3/Stray.jpg',
            'https://i.ibb.co/B5rZWyg9/Red Dead Redemption II-7.jpg',
            'https://i.ibb.co/v64zmwTR/Hollow Knight-8.jpg',
        ];
        
        foreach ($urls as $url) {
            Url::create(['url' => $url]);
        }
    }
}
