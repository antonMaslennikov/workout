<?php

namespace Database\Seeders;

use App\Models\Activitie;
use Database\Factories\ActivitieFactory;
use Illuminate\Database\Seeder;

class ActivitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // автоматически вызовется по соглашению имён фабрика
        Activitie::factory(10)->create();

        // тоже самое что и предыдущее только чуть нагляднее сразу с использованием фабрики
        ActivitieFactory::new()->count(5)->create();

        // тоже самое но не сохраняет в базу а возвращает коллекцию
        $activities = Activitie::factory(10)->make();
    }
}
