<?php

namespace Modules\Subscription\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;
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
        'key',
        'is_featured'
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
        'name',
        'description'
    ];

    /**
     * Eager loading
     *
     * @var array
     */
    protected $with = ['translations'];


    /**
     * Return a relation with PlanPrice
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

    /**
     * Relation with User
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Return relaiton with PlanSetting
     *
     * @return HasMany
     */
    public function settings(): HasMany
    {
        return $this->hasMany(PlanSetting::class);
    }

    /**
     * Return setting value by key
     *
     * @param $key
     * @return mixed
     */
    public function setting($key)
    {
        $setting = $this->settings->where('key', $key)->first();

        return $setting ? $setting->value : null;
    }
}
