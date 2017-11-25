<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Subscription\Http\Requests\Admin\PlansUpdateRequest;
use Modules\Subscription\Models\Period;
use Modules\Subscription\Models\Plan;
use Netcore\Translator\Helpers\TransHelper;

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
        $plan->load(['prices.period', 'options.option']);

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

        foreach ($request->get('prices', []) as $id => $price)
        {
            $plan->prices()->find($id)->update($price);
        }

        $languages = TransHelper::getAllLanguages();

        foreach ($plan->options as $option)
        {
            $translatedOptions = $request->get('options', [])[$option->id] ?? [];

            $translations = [];
            foreach ($languages as $language)
            {
                $value = $translatedOptions[$language->iso_code] ?? null;
                $translations[$language->iso_code] = [
                    'value' => $value == 'on' ? 1 : $value
                ];
            }
            $option->updateTranslations($translations);

        }

        return redirect()->back()
                         ->withSuccess('Plan was successfully updated!');
    }

}
