<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        $plans = config('netcore.module-subscription.plans', []);

        foreach ($plans as $plan)
        {
            $planModel = Plan::firstOrCreate(array_only($plan, 'key'));

            $translations = [];

            foreach ($plan['translations'] as $locale => $translation)
            {
                $translations[$locale] = $translation;
            }

            $planModel->updateTranslations($translations);

        }

    }
}
