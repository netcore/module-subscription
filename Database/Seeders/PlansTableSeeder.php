<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Models\Currency;
use Modules\Subscription\Models\Period;
use Modules\Subscription\Models\Plan;
use Modules\Subscription\Models\PlanPrice;
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

        foreach ($plans as $plan) {
            $planModel = Plan::firstOrCreate(
                array_only($plan, 'key'),
                array_except($plan, ['prices', 'settings', 'translations'])
            );

            $translations = [];

            foreach ($plan['translations'] as $locale => $translation) {
                $translations[$locale] = $translation;
            }

            $planModel->updateTranslations($translations);

            $currencies = Currency::pluck('id', 'key');
            $periods = Period::pluck('id', 'key');

            // Plan prices
            foreach (array_get($plan, 'prices', []) as $price) {
                PlanPrice::firstOrCreate([
                    'plan_id'           => $planModel->id,
                    'period_id'         => $periods[$price['period']],
                    'currency_id'       => $currencies[$price['currency']],
                    'braintree_plan_id' => $price['braintree_plan_id'],
                ])->update(array_only($price, ['monthly_price', 'original_price']));
            }

            // Plan settings
            foreach (array_get($plan, 'settings', []) as $key => $setting) {
                $planModel->settings()->firstOrCreate([
                    'key' => $key,
                ], $setting);
            }
        }
    }
}
