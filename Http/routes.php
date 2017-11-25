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

});
