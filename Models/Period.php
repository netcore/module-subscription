<?php

namespace Modules\Subscription\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Translations\PeriodTranslation;
use Modules\Translate\Traits\SyncTranslations;

class Period extends Model
{
    use Translatable, SyncTranslations;

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'days'
    ];

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__periods';

    /**
     * Translation model
     *
     * @var string
     */
    public $translationModel = PeriodTranslation::class;

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
     * Disable created_at and updated_at columns
     *
     * @var bool
     */
    public $timestamps = false;

}
