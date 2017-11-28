<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Http\Requests\Admin\CurrenciesUpdateRequest;
use Modules\Subscription\Models\Currency;

class CurrenciesController extends Controller
{
    /**
     * Blade view path
     */
    const BLADE = 'subscription::admin.currencies.';

    /**
     * Return table with all currencies
     *
     * @return $this
     */
    public function index()
    {
        $currencies = Currency::all();

        return view(self::BLADE . 'index')->with([
            'currencies'    =>  $currencies
        ]);
    }

    /**
     * Return edit form
     *
     * @param Currency $currency
     * @return $this
     */
    public function edit(Currency $currency)
    {
        return view(self::BLADE . 'edit')->with([
            'currency'  =>  $currency
        ]);
    }

    /**
     * Update currency and redirect back
     *
     * @param CurrenciesUpdateRequest $request
     * @param Currency $currency
     * @return mixed
     */
    public function update(CurrenciesUpdateRequest $request, Currency $currency)
    {
        $currency->update( $request->all() );
        $currency->updateTranslations( $request->get('translations', []) );

        return redirect()->back()
            ->withSuccess('Currency was successfully updated!');
    }
    
}
