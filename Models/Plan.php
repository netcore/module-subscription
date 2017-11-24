<?php

namespace Modules\Subscription\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Subscription\Translations\PlanTranslation;
use Modules\Translate\Traits\SyncTranslations;

class Plan extends Model
{
    use Translatable, SyncTranslations;

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'key'
    ];

    /**
     * Additional date columns
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plans';

    /**
     * Translation model
     *
     * @var string
     */
    public $translationModel = PlanTranslation::class;

    /**
     * Translateable attributes
     *
     * @var array
     */
    public $translatedAttributes = [
        'name'
    ];

    /**
     * Eager loading
     *
     * @var array
     */
    protected $with = ['translations'];


    /**
     * Return a relation with SubscriptionPrice
     *
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(PlanPrice::class);
    }

    /**
     * Return a relation with Option
     *
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(OptionPlan::class);
    }
}
