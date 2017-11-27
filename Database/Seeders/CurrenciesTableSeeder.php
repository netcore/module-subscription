<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $currencies = config('netcore.module-subscription.currencies', []);

        foreach ($currencies as $currency) {

            $currencyModel = Currency::firstOrCreate([
                'key' => $currency['key']
            ], [
                'symbol'    =>  $currency['symbol']
            ]);

            $translations = [];
            foreach ($currency['translations'] as $language => $translation)
            {
                $translations[$language] = $translation;
            }
            $currencyModel->updateTranslations($translations);

        }
    }
}
