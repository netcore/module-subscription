<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Models\Period;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $periods = config('netcore.module-subscription.periods', []);

        foreach ($periods as $period)
        {
            $periodModel = Period::create(array_except($period, 'translations'));

            $translations = [];
            foreach ($period['translations'] as $locale => $name) {
                $translations[$locale] = [
                    'name'  =>  $name
                ];
            }
            $periodModel->updateTranslations($translations);
        }

    }
}
