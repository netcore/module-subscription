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
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'is_featured',
        'is_highest_available',
    ];

    /**
     * Additional date columns.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'netcore_subscription__plans';

    /**
     * Translation model.
     *
     * @var string
     */
    public $translationModel = PlanTranslation::class;

    /**
     * Attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'name',
        'description'
    ];

    /**
     * Eager load relations.
     *
     * @var array
     */
    protected $with = ['translations', 'settings'];


    /**
     * Plan has many prices.
     *
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(PlanPrice::class);
    }

    /**
     * Plan has many options.
     *
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(OptionPlan::class);
    }

    /**
     * Plan has many users.
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Plan has many plan settings.
     *
     * @return HasMany
     */
    public function settings(): HasMany
    {
        return $this->hasMany(PlanSetting::class);
    }

    /**
     * Get the plan setting value.
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
