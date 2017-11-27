<?php

namespace Modules\Subscription\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Translations\CurrencyTranslation;
use Modules\Translate\Traits\SyncTranslations;

class Currency extends Model
{
    use Translatable, SyncTranslations;

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'symbol'
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
    protected $table = 'netcore_subscription__currencies';

    /**
     * Translation model
     *
     * @var string
     */
    public $translationModel = CurrencyTranslation::class;

    /**
     * Translateable attributes
     *
     * @var array
     */
    public $translatedAttributes = [
        'name',
    ];

    /**
     * Eager loading
     *
     * @var array
     */
    protected $with = ['translations'];

}
