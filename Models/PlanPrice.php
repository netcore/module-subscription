<?php

namespace Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanPrice extends Model
{
    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'currency_id',
        'period_id',
        'monthly_price',
        'original_price'
    ];

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plan_prices';

    /**
     * Return subscription period day count
     *
     * @return int|null
     */
    public function getDaysAttribute(): ?int
    {
        return $this->period->days;
    }

    /**
     * Return a relation with Plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Return a relation with Period
     *
     * @return BelongsTo
     */
    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * Return a relation with Currency
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Adds currency to query
     *
     * @param $query
     * @param $currency
     * @return mixed
     */
    public function scopeInCurrency($query, $currency)
    {
        $currenies = Currency::without('translations')->pluck('id', 'key');

        return $query->where('currency_id', $currenies[$currency]);
    }

    /**
     * @param $query
     * @param $period
     * @return mixed
     */
    public function scopeInPeriod($query, $period)
    {
        $periods = Period::without('translations')->pluck('id', 'key');

        return $query->where('period_id', $periods[$period]);
    }

}
