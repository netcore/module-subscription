<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Models\Period;
use Modules\Subscription\Models\Plan;
use Modules\Subscription\Observers\PlanObserver;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $periods = Period::pluck('id', 'key');
        $plans   = config('netcore.module-subscription.plans', []);

        foreach ($plans as $plan)
        {
            $planModel = Plan::firstOrCreate(array_only($plan, 'key'));

            $translations = [];

            foreach ($plan['translations'] as $locale => $translation)
            {
                $translations[$locale] = $translation;
            }

            $planModel->updateTranslations($translations);

            foreach ($plan['prices'] as $price) {

                $planModel->prices()
                          ->where('period_id', $periods[$price['period']])
                          ->first()
                          ->update(array_only($price, 'monthly_price'));


            }

        }

    }
}
