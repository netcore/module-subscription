<?php

namespace Modules\Subscription\Translations;

use Illuminate\Database\Eloquent\Model;

class OptionPlanTranslation extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__option_plan_translations';

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'locale',
        'value'
    ];

    /**
     * Disable timestamps
     *
     * @var bool
     */
    public $timestamps = false;

}