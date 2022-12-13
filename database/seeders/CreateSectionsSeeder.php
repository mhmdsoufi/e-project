<?php

namespace Database\Seeders;

use App\Models\sections;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateSectionsSeeder extends Seeder
{
    public function run()
    {
        sections::create([
            'section_name' => 'Al_Haram',
            'description' => 'First Section',
            'Created_by' => User::first()->pluck('name'),
        ]);
        sections::create([
                'section_name' => 'Al_Fouad',
                'description' => 'Second Section',
                'Created_by' => User::first()->pluck('name'),
        ]);
        sections::create ([
                'section_name' => 'Bank QNB',
                'description' => 'Third Section',
                'Created_by' => User::first()->pluck('name'),
        ]);
        sections::create([
                'section_name' => 'Bank Bemo',
                'description' => 'Forth Section',
                'Created_by' => User::first()->pluck('name'),
            ]);
    }
}
