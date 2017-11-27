<?php

namespace Modules\Subscription\Translations;

use Illuminate\Database\Eloquent\Model;

class CurrencyTranslation extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_subscription__currency_translations';

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