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
        'plan_id',
        'user_id',
        'is_paid',
        'expires_at',
        'cancelled_at'
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
     * Return a relation with Plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
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

    public function cancel(): bool
    {
        return $this->update([
            'cancelled_at'  =>  Carbon::now()
        ]);
    }

}
