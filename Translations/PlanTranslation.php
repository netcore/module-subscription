<?php

namespace Modules\Subscription\Translations;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plan_translations';

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'locale',
        'name'
    ];

    /**
     * Disable timestamps
     *
     * @var bool
     */
    public $timestamps = false;

}