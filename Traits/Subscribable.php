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
                    ->with('planPrice');
    }

    /**
     * Return a relation with PlanPrice
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
            'plan_price_id' =>  $price->id,
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

    /**
     * Renew subscription
     *
     * @param bool $paid
     * @return Subscription|null
     */
    public function renewSubscription(bool $paid): ?Subscription
    {
        $subscription = $this->subscription;
        if (!$subscription) return null;

        return $subscription->renew($paid);
    }

}