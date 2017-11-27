<?php
namespace Modules\Subscription\Observers;

use Modules\Subscription\Models\Period;
use Modules\Subscription\Models\PlanPrice;

class PlanObserver
{

    /**
     * Assign prices to new plan
     *
     * @param $plan
     */
    public function created($plan): void
    {
        $periods    = Period::all();
        $currencies = Period::all();

        $planPrices = [];
        foreach ($currencies as $currency)
        {
            foreach ($periods as $period)
            {
                $planPrices[] = [
                    'plan_id'       =>  $plan->id,
                    'period_id'     =>  $period->id,
                    'currency_id'   =>  $currency->id
                ];
            }
        }


        PlanPrice::insert($planPrices);
    }

}
