<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $people = [
            [
//                "chatid" => null,
                "name" => 'Bekhruz',
//                "username" => null,
                "phone" => '+998945488666'
            ],
            [
//                "chatid" => null,
                "name" => 'qwerty',
//                "username" => null,
                "phone" => '+9989332228833'
            ]
        ];

        foreach ($people as $person)
        {
            $p = new People();
//            $p->chatid = $person['chatid'];
            $p->name = $person['name'];
//            $p->username = $person['username'];
            $p->phone = $person['phone'];
            $p->save();
        }
    }
}
