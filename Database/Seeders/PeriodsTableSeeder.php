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
            $periodModel = Period::firstOrCreate(array_only($period, 'key'), array_except($period, 'translations'));

            $translations = [];

            foreach ($period['translations'] as $locale => $translation)
            {
                $translations[$locale] = $translation;
            }

            $periodModel->updateTranslations($translations);
        }

    }
}
