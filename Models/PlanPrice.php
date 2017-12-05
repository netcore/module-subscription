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
        'original_price',
        'braintree_plan_id'
    ];

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plan_prices';

    /**
     * Load currency together with price
     *
     * @var array
     */
    protected $with = ['currency'];

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
     * Adds period to query
     *
     * @param $query
     * @param $period
     * @return mixed
     */
    public function scopeInPeriod($query, $period)
    {
        $periods = Period::without('translations')->pluck('id', 'key');

        return $query->where('period_id', $periods[$period]);
    }

    /**
     * Order prices by lowest first
     *
     * @param $query
     * @return mixed
     */
    public function scopeLowest($query)
    {
        return $query->orderBy('monthly_price', 'ASC');
    }

    /**
     * Return formatted monthly price
     *
     * @return string
     */
    public function getFormattedMonthlyPriceAttribute(): string
    {
        return $this->monthly_price . $this->currency->symbol;
    }

    /**
     * Return full price
     *
     * @return float|null
     */
    public function getFullPriceAttribute(): ?float
    {
        return (round($this->period->days / 30) * $this->monthly_price);
    }

    /**
     * Return full formatted price
     *
     * @return null|string
     */
    public function getFormattedFullPriceAttribute(): ?string
    {
        return $this->full_price . $this->currency->symbol;
    }

}
