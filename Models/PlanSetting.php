<?php

namespace Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanSetting extends Model
{
    /**
     * @TODO: Add more types
     * Allowed setting types
     */
    const TYPES = [
        'integer'
    ];

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'key',
        'type',
        'value'
    ];

    /**
     * Disable created_at and updated_at columns
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plan_settings';

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
     * Cast value in correct data type
     * @TODO: Add more types
     *
     * @param $value
     * @return int
     */
    public function getValueAttribute($value)
    {
        switch ($this->type)
        {
            case 'integer':
                return (int) $value;
        }

        return $value;
    }

}
