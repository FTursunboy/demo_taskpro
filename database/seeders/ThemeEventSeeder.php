<?php

namespace Database\Seeders;

use App\Models\Admin\CRM\ThemeEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThemeEvent::create([
           'theme' => 'Автоматизация'
        ]);
        ThemeEvent::create([
           'theme' => 'Программирование'
        ]);
        ThemeEvent::create([
           'theme' => 'Внедрение'
        ]);
        ThemeEvent::create([
           'theme' => 'Консультация'
        ]);
        ThemeEvent::create([
           'theme' => 'Обучение'
        ]);
        ThemeEvent::create([
           'theme' => 'Сопровождение'
        ]);
        ThemeEvent::create([
           'theme' => 'Сотрудничество'
        ]);
        ThemeEvent::create([
           'theme' => 'Другое'
        ]);
    }
}
