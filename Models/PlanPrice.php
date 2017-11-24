<?php

namespace Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanPrice extends Model
{
    /**
     * Billing periods
     */
    const PERIODS = [
        'monthly',
        'quarterly',
        'semi-annually',
        'annually'
    ];

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'period',
        'monthly_price'
    ];

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plan_prices';


    /**
     * Return a relation with Plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

}
