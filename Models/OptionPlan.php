<?php

namespace Modules\Subscription\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Translations\OptionPlanTranslation;
use Modules\Translate\Traits\SyncTranslations;

class OptionPlan extends Model
{
    use Translatable, SyncTranslations;

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'option_id',
        'plan_id'
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
    protected $table = 'netcore_subscription__option_plan';

    /**
     * Translation model
     *
     * @var string
     */
    public $translationModel = OptionPlanTranslation::class;

    /**
     * Translateable attributes
     *
     * @var array
     */
    public $translatedAttributes = [
        'value'
    ];

    /**
     * Eager loading
     *
     * @var array
     */
    protected $with = ['translations'];

}
