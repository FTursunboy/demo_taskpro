<?php

namespace Database\Seeders;

use App\Models\Admin\EmailModel;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectTypeModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Statuses;
use App\Models\Types;
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
        ]);


        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'user'
        ]);
        Role::create([
            'name' => 'client'
        ]);

        Role::create([
            'name' => 'client-worker'
        ]);
        Role::create([
            'name' => 'team-lead'
        ]);
        Role::create([
            'name' => 'crm'
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
            'name' => 'Проссроченное'
        ]);
        StatusesModel::create([
            'name' => 'Ожидается (Админ)'
        ]);
        StatusesModel::create([
            'name' => 'Ожидается (Сотрудник)'
        ]);
        StatusesModel::create([
            'name' => 'На проверке (У клиента)'
        ]);
        StatusesModel::create([
            'name' => 'Отклонено (Администратор)'
        ]);
        StatusesModel::create([
            'name' => 'Отклонено (Сотрудник)'
        ]);
        StatusesModel::create([
            'name' => 'Отклонено (Клиентом)'
        ]);
        StatusesModel::create([
            'name' => 'На проверке (У админа)'
        ]);

        OtdelsModel::create([
            'name' => 'FIN Group',
        ]);

        OtdelsModel::create([
            'name' => 'Веб -разработка',
        ]);

        OtdelsModel::create([
            'name' => '1с - разработка',
        ]);

        OtdelsModel::create([
            'name' => 'Развития',
        ]);
        OtdelsModel::create([
            'name' => 'Клиенты',
        ]);

        TaskTypeModel::create([
            'name' => 'Разовые',
        ]);
        TaskTypeModel::create([
            'name' => 'KPI',
        ]);
        TaskTypeModel::create([
            'name' => 'Другие',
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Январь',
            'typeTask_id' => 2,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Февраль',
            'typeTask_id' => 2,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Март',
            'typeTask_id' => 2,
        ]);
        TaskTypesTypeModel::create([
            'name' => 'Апрель',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Май',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Июнь',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Июль',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Август',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Сентябр',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Октябр',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Ноябр',
            'typeTask_id' => 2,
        ]);

        TaskTypesTypeModel::create([
            'name' => 'Декабр',
            'typeTask_id' => 2,
        ]);

        ProjectTypeModel::create([
            'name' => 'Создание сайт',
        ]);
        ProjectTypeModel::create([
            'name' => 'Доработка сайтов',
        ]);
        ProjectTypeModel::create([
            'name' => 'Доработка 1с',

        ]);
        ProjectTypeModel::create([
            'name' => 'Обучение',

        ]);
        ProjectTypeModel::create([
            'name' => 'FIN Group',
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
            'slug' => Str::slug(Str::random(6) . ' ' . "Nuriddin Shahobov " . Str::random(4), '-'),
        ])->assignRole('admin');

        Types::create([
            'name' => 'внутренный'
        ]);
        Types::create([
            'name' => 'внешний'
        ]);

        Statuses::create([
            'name' => 'Создал'
        ]);
        Statuses::create([
            'name' => 'Отправил'
        ]);
        Statuses::create([
            'name' => 'Принял'
        ]);
        Statuses::create([
            'name' => 'Отклонил'
        ]);
        Statuses::create([
            'name' => 'Подтвердил'
        ]);
        Statuses::create([
            'name' => 'Отправил на проверку'
        ]);
        Statuses::create([
            'name' => 'Просроченное'
        ]);
        Statuses::create([
            'name' => 'Изменил'
        ]);
        Statuses::create([
            'name' => 'Удалил'
        ]);
        Statuses::create([
            'name' => 'Отправил заново'
        ]);
        Statuses::create([
            'name' => 'Отправил сотруднику'
        ]);
        $this->call(LeadSeeder::class);
        $this->call(ThemeEventSeeder::class);
        $this->call(TypeEventSeeder::class);
        $this->call(EventStatusSeeder::class);

    }
}
