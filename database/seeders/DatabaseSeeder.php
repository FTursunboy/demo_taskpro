<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\EmailModel;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectTypeModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        EmailModel::create([
            'email' => 'fingroup.task@gmail.com',
            'status' => true,
        ]);
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'user'
        ]);
        Role::create([
            'name' => 'incs'
        ]);

        User::create([
            'name' => 'Nuriddin',
            'surname' => 'Shahobov',
            'lastname' => 'Farrukhovich',
            'phone' => '+992987671091',
            'login' => 'admin',
            'password' => Hash::make('password'),
            'position' => 'Admin',
            'otdel_slug' => null,
            'telegram_user_id' => 5205653584,
            'xp' => 5205653584,
            'status' => true,
            'slug' => Str::slug(Str::random(6) . ' ' . "Nuriddin Shahobov " . Str::random(4), '-'),
        ])->assignRole('admin');

        StatusesModel::create([
            'name' => 'Ожидается'
        ]);
        StatusesModel::create([
            'name' => 'В процессе'
        ]);
        StatusesModel::create([
            'name' => 'Готов'
        ]);
        StatusesModel::create([
            'name' => 'Принято'
        ]);
        StatusesModel::create([
            'name' => 'Отклонено'
        ]);
        StatusesModel::create([
            'name' => 'На проверку'
        ]);
        StatusesModel::create([
            'name' => 'Прассрочное'
        ]);

        OtdelsModel::create([
            'name' => 'Веб -разработка',
            'status' => true,
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-')
        ]);

        OtdelsModel::create([
            'name' => '1с - разработка',
            'status' => true,
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-')
        ]);

        OtdelsModel::create([
            'name' => 'Развития',
            'status' => true,
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-')
        ]);
        OtdelsModel::create([
            'name' => 'Клиенты',
            'status' => true,
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-')
        ]);

        TaskTypeModel::create([
            'typeTask' => 'Разовые',
            'status' => true
        ]);
        TaskTypeModel::create([
            'typeTask' => 'KPI',
            'status' => true
        ]);
        TaskTypeModel::create([
            'typeTask' => 'Другие',
            'status' => true
        ]);
        TaskTypesTypeModel::create([
            'name' => '1 меcячный',
            'typeTask_id' => 2,
            'status' => true,
        ]);
        TaskTypesTypeModel::create([
            'name' => '3 меcячный',
            'typeTask_id' => 2,
            'status' => true,
        ]);
        TaskTypesTypeModel::create([
            'name' => '6 меcячный',
            'typeTask_id' => 2,
            'status' => true,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Годовой',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        ProjectTypeModel::create([
            'typeProject' => 'Создание сайт',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'typeProject' => 'Доработка сайтов',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'typeProject' => 'Доработка 1с',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'typeProject' => 'Обучение',
            'status' => true
        ]);
    }
}
