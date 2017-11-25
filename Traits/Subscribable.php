<?php
namespace Modules\Subscription\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Subscription\Models\PlanPrice;
use Modules\Subscription\Models\Subscription;

trait Subscribable {

    /**
     * Return a relation with Subscription
     *
     * @return HasOne
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
                    ->active()
                    ->with('plan');
    }

    /**
     * Return a relation with Plan
     *
     * @return HasOne
     */
    public function plan()
    {
        $subscription = $this->subscription;

        return $subscription ? $subscription->plan() : $this->subscription();
    }

    /**
     * Create a subscription
     *
     * @param PlanPrice $price
     * @return Subscription
     */
    public function subscribe(PlanPrice $price): Subscription
    {
        $subscription = $this->subscription;
        if ($subscription) return $subscription;

        return $this->subscription()->create([
            'plan_id'       =>  $price->plan_id,
            'expires_at'    =>  Carbon::now()->addDays($price->days)
        ]);
    }

    /**
     * Cancel subscription
     *
     * @return bool
     */
    public function cancelSubscription(): bool
    {
        $subscription = $this->subscription;
        if (!$subscription) return false;

        return $subscription->cancel();
    }

}