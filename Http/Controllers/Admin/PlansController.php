<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Subscription\Http\Requests\Admin\PlansUpdateRequest;
use Modules\Subscription\Models\Plan;

class PlansController extends Controller
{
    /**
     * Blade view path
     */
    const BLADE = 'subscription::admin.plans.';

    /**
     * Return view with all plans
     *
     * @return $this
     */
    public function index()
    {
        $plans = Plan::all();

        return view(self::BLADE . 'index')->with([
            'plans' =>  $plans
        ]);
    }

    /**
     * Return plan edit form
     *
     * @param Plan $plan
     * @return $this
     */
    public function edit(Plan $plan)
    {
        return view(self::BLADE . 'edit')->with([
            'plan'  =>  $plan
        ]);
    }

    /**
     * Update plan and redirect back with a success message
     *
     * @param PlansUpdateRequest $request
     * @param Plan $plan
     * @return mixed
     */
    public function update(PlansUpdateRequest $request, Plan $plan)
    {
        $request->merge([
            'is_featured'   =>  $request->has('is_featured')
        ]);

        $plan->update( $request->all() );
        $plan->updateTranslations( $request->get('translations', []) );

        return redirect()->back()
                         ->withSuccess('Plan was successfully updated!');
    }

}
