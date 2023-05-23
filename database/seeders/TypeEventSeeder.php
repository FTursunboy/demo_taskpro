<?php

namespace Database\Seeders;

use App\Models\Admin\CRM\TypeEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeEvent::create([
            'name' => 'Телефонный разговор',
        ]);
        TypeEvent::create([
            'name' => 'Личная встреча',
        ]);
        TypeEvent::create([
            'name' => 'Электронное письмо',
        ]);
        TypeEvent::create([
            'name' => 'SMS-сообщение',
        ]);
        TypeEvent::create([
            'name' => 'Прочее',
        ]);
    }
}
