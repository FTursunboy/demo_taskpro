<?php

namespace Database\Seeders;

use App\Models\Admin\CRM\Event;
use App\Models\Admin\CRM\EventStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventStatus::insert([
            ['name' => 'Запланированный'],
            ['name' => 'В работе'],
            ['name' => 'Просроченный'],
        ]);
    }
}
