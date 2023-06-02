<?php

namespace Database\Seeders;

use App\Models\Admin\CRM\LeadSource;
use App\Models\Admin\CRM\LeadState;
use App\Models\Admin\CRM\LeadStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeadSource::create([
            'name' => 'Социальные сети',
        ]);
        LeadSource::create([
            'name' => 'Сарафанное радио',
        ]);
        LeadSource::create([
            'name' => 'Tv и Radio',
        ]);

        LeadStatus::create([
            'name' => 'Первичное обращение'
        ]);

        LeadStatus::create([
            'name' => 'Потенциальный клиент'
        ]);

        LeadStatus::create([
            'name' => 'Договор'
        ]);
        LeadStatus::create([
            'name' => 'Оплата'
        ]);
        LeadStatus::create([
            'name' => 'Некачественный лид',
        ]);

        LeadState::create([
            'name' => 'Не обработан',
        ]);

        LeadState::create([
           'name' => 'В работе',
        ]);

        LeadState::create([
            'name' => 'Завершен',
        ]);

        LeadState::create([
            'name' => 'Неизвестно',
        ]);

        LeadState::create([
            'name' => 'Другое',
        ]);
    }
}
