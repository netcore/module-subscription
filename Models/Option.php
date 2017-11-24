<?php

namespace Modules\Subscription\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Translations\OptionTranslation;
use Modules\Translate\Traits\SyncTranslations;

class Option extends Model
{
    use Translatable, SyncTranslations;

    /**
     * Option types
     */
    const TYPES = [
        'boolean',
        'text'
    ];

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'type',
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
    protected $table = 'netcore_subscription__options';

    /**
     * Translation model
     *
     * @var string
     */
    public $translationModel = OptionTranslation::class;

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

}
