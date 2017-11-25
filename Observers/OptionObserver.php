<?php
namespace Modules\Subscription\Observers;

use Modules\Subscription\Models\OptionPlan;
use Modules\Subscription\Models\Plan;

class OptionObserver
{

    /**
     * Assign the new option to all plans
     *
     * @param $option
     */
    public function created($option)
    {
        $plans = Plan::all();

        $optionPlans = [];
        foreach ($plans as $plan)
        {
            $optionPlans[] = [
                'plan_id'   =>  $plan->id,
                'option_id' =>  $option->id
            ];
        }

        OptionPlan::insert($optionPlans);

    }

}
