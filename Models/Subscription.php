<?php

namespace Modules\Subscription\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

class Subscription extends Model
{
    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'plan_price_id',
        'user_id',
        'is_paid',
        'expires_at',
        'cancelled_at'
    ];

    /**
     * Date mutations
     *
     * @var array
     */
    public $dates = [
        'expires_at', 'cancelled_at'
    ];

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__subscriptions';


    /**
     * Return active subscriptions
     *
     * @param $query
     * @return Builder
     */
    public function scopeActive($query): Builder
    {
        return $query->whereNull('cancelled_at')
                     ->where('expires_at', '>=', Carbon::now());
    }

    /**
     * Return a relation with PlanPrice
     *
     * @return BelongsTo
     */
    public function planPrice(): BelongsTo
    {
        return $this->belongsTo(PlanPrice::class);
    }

    /**
     * Return relation with Plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->planPrice->plan();
    }

    /**
     * Return a relation with User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cancel subscription
     *
     * @return bool
     */
    public function cancel(): bool
    {
        return $this->update([
            'cancelled_at'  =>  Carbon::now()
        ]);
    }

    /**
     * Renew subscription
     *
     * @param bool $paid
     * @return Subscription
     */
    public function renew(bool $paid): self
    {
        $this->update([
            'expires_at'    =>  $this->expires_at->addDays($this->planPrice->days),
            'is_paid'       =>  $paid
        ]);

        return $this;
    }

}
