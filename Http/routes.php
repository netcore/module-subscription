<?php

Route::group(['middleware' => 'web', 'prefix' => 'subscription', 'namespace' => 'Modules\Subscription\Http\Controllers'], function()
{
    Route::get('/', 'SubscriptionController@index');
});
