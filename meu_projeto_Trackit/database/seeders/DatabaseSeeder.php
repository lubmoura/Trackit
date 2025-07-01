<?php

namespace Database\Seeders;

use App\Models\Url;
use App\Models\User;
use App\Models\Journal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 public function run(): void
    {
        
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
            'https://i.ibb.co/wxL3YFc/Zelda Breath of the Wild.jpg',
            'https://i.ibb.co/DD0Z6b82/Grand Theft Auto V.jpg',
            'https://i.ibb.co/ZRP02KSG/The sims 4.jpg',
            'https://i.ibb.co/Pz6Ft0BK/Life is Strange.jpg',
            'https://i.ibb.co/35vctLBw/Skyrim.jpg',
            'https://i.ibb.co/Y73cTsgX/FireWatch.jpg',
            'https://i.ibb.co/6RH21vp3/Stray.jpg',
            'https://i.ibb.co/B5rZWyg9/Red Dead Redemption II.jpg',
            'https://i.ibb.co/v64zmwTR/Hollow Knight.jpg',
        ];

        foreach ($urls as $url) {
            Url::updateOrCreate(
                ['url' => $url]  
            );
        }

        
        $journals = [
            [
                'game_title' => 'The Last Of Us Part 2',
                'story' => 'In a post-apocalyptic America, Ellie embarks on a deeply personal and emotional journey of revenge and redemption. Facing harsh enemies and moral dilemmas, she navigates a world filled with danger, loss, and hope.',
            ],
            [
                'game_title' => 'Zelda Breath Of The Wild',
                'story' => 'Link awakens after a hundred years in a ruined Hyrule to a world filled with mystery and danger. With freedom to explore vast landscapes, ancient ruins, and fight against the evil Calamity Ganon, Link must save the kingdom and uncover forgotten legends.',
            ],
            [
                'game_title' => 'Grand Theft Auto V',
                'story' => 'Set in the sprawling city of Los Santos, three very different criminals — Michael, Franklin, and Trevor — cross paths in a thrilling tale of crime, loyalty, and betrayal. Players undertake heists, evade law enforcement, and explore a satirical take on modern American life.',
            ],
            [
                'game_title' => 'The Sims 4',
                'story' => 'Create and control Sims, virtual people with unique personalities, dreams, and struggles. Build their homes, shape their lives, careers, and relationships in an open-ended simulation where anything can happen.',
            ],
            [
                'game_title' => 'Life Is Strange',
                'story' => 'Max Caulfield, a photography student, discovers she can rewind time and alter the course of events. As she investigates mysterious disappearances and uncovers dark secrets in the town of Arcadia Bay, Max must face the consequences of her choices.',
            ],
            [
                'game_title' => 'Skyrim',
                'story' => 'In the ancient land of Skyrim, the Dragonborn rises to face a deadly prophecy. Harness powerful shouts, forge alliances, and battle dragons threatening to destroy the world in an epic open-world RPG full of lore and adventure.',
            ],
            [
                'game_title' => 'FireWatch',
                'story' => 'As a fire lookout in the Wyoming wilderness, Henry communicates with his supervisor Delilah via radio while uncovering strange occurrences in the forest. A story about isolation, trust, and mystery unfolds amidst breathtaking natural scenery.',
            ],
            [
                'game_title' => 'Stray',
                'story' => 'Play as a lost stray cat in a neon-lit cybercity inhabited by robots and mysterious creatures. Solve puzzles, explore hidden alleys, and uncover the secrets behind this dystopian world in a unique adventure.',
            ],
            [
                'game_title' => 'Red Dead Redemption II',
                'story' => 'Arthur Morgan, a loyal member of the Van der Linde gang, struggles with his own morality as the Wild West fades away. Experience a richly detailed story of loyalty, betrayal, and survival in the dying days of outlaws and frontier life.',
            ],
            [
                'game_title' => 'Hollow Knight',
                'story' => 'Dive into the eerie yet beautiful world of Hallownest, a vast underground kingdom full of insects and ancient mysteries. As a silent knight, explore ruined cities, battle challenging foes, and uncover the fate of the fallen kingdom.',
            ],
        ];

        foreach ($journals as $journal) {
            Journal::updateOrCreate(
                ['game_title' => $journal['game_title']],
                ['story' => $journal['story']]
            );
        }
    }
}
