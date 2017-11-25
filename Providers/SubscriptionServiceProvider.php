<?php

namespace Modules\Subscription\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Subscription\Models\Option;
use Modules\Subscription\Models\Plan;
use Modules\Subscription\Models\Subscription;
use Modules\Subscription\Observers\OptionObserver;
use Modules\Subscription\Observers\PlanObserver;
use Modules\Subscription\Observers\SubscriptionObserver;

class SubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->registerObservers();
        $this->registerValidators();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('netcore/module-subscription.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'subscription'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/subscription');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/subscription';
        }, \Config::get('view.paths')), [$sourcePath]), 'subscription');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/subscription');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'subscription');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'subscription');
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/Database/factories');
        }
    }

    /**
     * Register observers
     */
    public function registerObservers()
    {
        Option::observe(OptionObserver::class);
        Plan::observe(PlanObserver::class);
    }

    /**
     * Register validators
     */
    public function registerValidators()
    {
        Validator::extend('decimal', function ($attribute, $value, $parameters, $validator) {
            return !$value || $value >= $parameters[0] && $value <= $parameters[1];
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
