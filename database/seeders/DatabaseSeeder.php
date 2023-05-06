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

        StatusesModel::create([
            'name' => 'Ожидается',
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
            'name' => 'FIN Group',
            'status' => true,
        ]);

        OtdelsModel::create([
            'name' => 'Веб -разработка',
            'status' => true,
        ]);

        OtdelsModel::create([
            'name' => '1с - разработка',
            'status' => true,
        ]);

        OtdelsModel::create([
            'name' => 'Развития',
            'status' => true,
        ]);
        OtdelsModel::create([
            'name' => 'Клиенты',
            'status' => true,
        ]);

        TaskTypeModel::create([
            'name' => 'Разовые',
            'status' => true
        ]);
        TaskTypeModel::create([
            'name' => 'KPI',
            'status' => true
        ]);
        TaskTypeModel::create([
            'name' => 'Другие',
            'status' => true
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Январь',
            'typeTask_id' => 2,
            'status' => true,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Февраль',
            'typeTask_id' => 2,
            'status' => true,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Март',
            'typeTask_id' => 2,
            'status' => true,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Апрель',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Май',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Июнь',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Июль',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Август',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Сентябр',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Октябр',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Ноябр',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Декабр',
            'typeTask_id' => 2,
            'status' => true,
        ]);

        ProjectTypeModel::create([
            'name' => 'Создание сайт',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'name' => 'Доработка сайтов',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'name' => 'Доработка 1с',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'name' => 'Обучение',
            'status' => true
        ]);
        ProjectTypeModel::create([
            'name' => 'FIN Group',
            'status' => true
        ]);
        User::create([
            'name' => 'Nuriddin',
            'surname' => 'Shahobov',
            'lastname' => 'Farrukhovich',
            'phone' => '+992987671091',
            'login' => 'admin',
            'password' => Hash::make('password'),
            'position' => 'Admin',
            'otdel_id' => 1,
            'telegram_user_id' => 5205653584,
            'xp' => 100,
            'status' => true,
            'slug' => Str::slug(Str::random(6) . ' ' . "Nuriddin Shahobov " . Str::random(4), '-'),
        ])->assignRole('admin');

    }
}
