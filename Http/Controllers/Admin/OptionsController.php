<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Subscription\Http\Requests\Admin\OptionsRequest;
use Modules\Subscription\Models\Option;

class OptionsController extends Controller
{
    /**
     * Blade view path
     */
    const BLADE = 'subscription::admin.options.';

    /**
     * Return view with all options
     *
     * @return $this
     */
    public function index()
    {
        $options = Option::all();

        return view(self::BLADE . 'index')->with([
            'options'   =>  $options
        ]);
    }

    /**
     * Return period edit form
     *
     * @param Option $option
     * @return $this
     */
    public function edit(Option $option)
    {
        return view(self::BLADE . 'edit')->with([
            'option'    =>  $option,
            'types'     =>  $this->getTypes()
        ]);
    }

    /**
     * Return create form
     *
     * @return $this
     */
    public function create()
    {
        return view(self::BLADE . 'create')->with([
            'types'     =>  $this->getTypes()
        ]);
    }

    /**
     * Store option
     *
     * @param OptionsRequest $request
     * @return mixed
     */
    public function store(OptionsRequest $request)
    {
        $option = Option::create($request->all());
        $option->updateTranslations( $request->get('translations', []) );

        return redirect()->route('admin::subscriptions.options.index')
            ->withSuccess('Option was successfully create!');
    }

    /**
     * Update option and redirect back with a success message
     *
     * @param OptionsRequest $request
     * @param Option $option
     * @return mixed
     */
    public function update(OptionsRequest $request, Option $option)
    {
        $option->update( $request->all() );
        $option->updateTranslations( $request->get('translations', []) );

        return redirect()->back()
                         ->withSuccess('Option was successfully updated!');
    }

    /**
     * Delete option and redirect
     *
     * @param Option $option
     * @return mixed
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('admin::subscriptions.options.index')
                         ->withSuccess('Option was successfully deleted!');
    }

    /**
     * Return key => value option type list
     *
     * @return Collection
     */
    protected function getTypes(): Collection
    {
        return collect(Option::TYPES)
                ->flip()
                ->map(function ($value, $key) {
                    return ucfirst($key);
                });
    }

}
