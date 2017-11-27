<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Models\Currency;
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

        $plans   = config('netcore.module-subscription.plans', []);

        foreach ($plans as $plan)
        {
            $planModel = Plan::firstOrCreate(array_only($plan, 'key'), ['is_featured'   =>  $plan['is_featured'] ?? false]);

            $translations = [];

            foreach ($plan['translations'] as $locale => $translation)
            {
                $translations[$locale] = $translation;
            }

            $planModel->updateTranslations($translations);

            $currencies = Currency::pluck('id', 'key');
            $periods    = Period::pluck('id', 'key');

            foreach ($plan['prices'] as $price) {

                $planModel->prices()
                          ->where('period_id', $periods[$price['period']])
                          ->where('currency_id', $currencies[$price['currency']])
                          ->first()
                          ->update(array_only($price, ['monthly_price', 'original_price']));


            }

            foreach ($plan['settings'] as $key => $setting)
            {
                $planModel->settings()
                          ->firstOrCreate([
                              'key' =>  $key
                          ], $setting);
            }

        }

    }
}
