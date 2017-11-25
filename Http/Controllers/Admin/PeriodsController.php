<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Subscription\Http\Requests\Admin\PeriodsUpdateRequest;
use Modules\Subscription\Http\Requests\Admin\PlansUpdateRequest;
use Modules\Subscription\Models\Period;
use Modules\Subscription\Models\Plan;

class PeriodsController extends Controller
{
    /**
     * Blade view path
     */
    const BLADE = 'subscription::admin.periods.';

    /**
     * Return view with all billing periods
     *
     * @return $this
     */
    public function index()
    {
        $periods = Period::all();

        return view(self::BLADE . 'index')->with([
            'periods'   =>  $periods
        ]);
    }

    /**
     * Return period edit form
     *
     * @param Period $period
     * @return $this
     */
    public function edit(Period $period)
    {
        return view(self::BLADE . 'edit')->with([
            'period'    =>  $period
        ]);
    }

    /**
     * Update period and redirect back with a success message
     *
     * @param PeriodsUpdateRequest $request
     * @param Period $period
     * @return mixed
     */
    public function update(PeriodsUpdateRequest $request, Period $period)
    {
        $period->update( $request->all() );
        $period->updateTranslations( $request->get('translations', []) );

        return redirect()->back()
                         ->withSuccess('Period was successfully updated!');
    }

}
