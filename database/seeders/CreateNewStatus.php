<?php

namespace Database\Seeders;

use App\Models\Admin\StatusesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateNewStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusesModel::create([
            'name' => 'Подтверждено тимлидом'
        ]);
    }
}
