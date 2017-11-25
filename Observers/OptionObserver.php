<?php
namespace Modules\Subscription\Observers;

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

        foreach ($plans as $plan)
        {
            $plan->options()->create([
                'option_id' =>  $option->id
            ]);
        }

    }

}
