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
        $periods = Period::all();

        $planPrices = [];
        foreach ($periods as $period)
        {
            $planPrices[] = [
                'plan_id'   =>  $plan->id,
                'period_id' =>  $period->id
            ];
        }

        PlanPrice::insert($planPrices);
    }

}
