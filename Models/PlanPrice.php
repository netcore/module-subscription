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
     * Return full period price
     *
     * @return float
     */
    public function getFullPriceAttribute(): float
    {
        return $this->period_in_months * $this->monthly_price;
    }

    /**
     * Return full original price
     *
     * @return float
     */
    public function getFullOriginalPriceAttribute(): float
    {
        return $this->period_in_months * $this->original_price;
    }

    /**
     * Return full plan period
     *
     * @return float
     */
    public function getPeriodInMonthsAttribute(): float
    {
        return floor($this->period->days / 30);
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

    /**
     * Calculates savings in % against the given price
     *
     * @param PlanPrice $against
     * @return int
     */
    public function savings(self $against): int
    {
        $periodPrice = $this->full_price;
        $againstPrice = $against->monthly_price * round(($this->period->days / 30));


        return (($againstPrice - $periodPrice) / $periodPrice) * 100;
    }
    
}
