<?php

Route::group([
    'middleware' => ['web', 'auth.admin'],
    'prefix'     => '/admin/subscriptions',
    'as'         => 'admin::subscriptions.',
    'namespace'  => 'Modules\Subscription\Http\Controllers\Admin'
], function()
{

    Route::resource('/plans', 'PlansController', [
        'only'  =>  ['index', 'edit', 'update']
    ]);

    Route::resource('/periods', 'PeriodsController', [
        'only'  =>  ['index', 'edit', 'update']
    ]);

    Route::resource('/options', 'OptionsController', [
        'except'    =>  'show'
    ]);

    Route::resource('/currencies', 'CurrenciesController', [
        'except'    =>  'show'
    ]);

});
