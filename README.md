## Description
This module allows you to manage subscription plans and let users to subscribe to plans.

## Pre-installation

This package is part of Netcore CMS ecosystem and is only functional in a project that has the following packages
installed:

1. https://github.com/netcore/netcore
2. https://github.com/netcore/module-admin
3. https://github.com/netcore/module-translate

### Installation

* Require this package using composer
```
composer require netcore/module-subscription
```

* Publish configuration/migrations
```
php artisan module:publish-config Subscription
php artisan module:publish-migration Subscription
php artisan migrate
```

* Configure plans and billing periods in `config/netcore/module-subscription.php` file.

* Seed the configuration to database
```
php artisan module:seed Subscription
```

* Add `Modules\Subscription\Traits\Subscribable` trait to your `User` model

### Usage

* Subscribe to a plan with price specification
```
$plan      = Modules\Subscription\Models\Plan::where('key', 'premium')->first();
$planPrice = $plan->prices()->inPeriod('monthly')->first();
$user      = App\User::first();
$user->subscribe($planPrice, true);
/*
 The boolean stands for whether the user has already paid for the subscription or not.
 If a boolean is not provided, it'll be automatically set to false.
*/
```

* Get user plan
```
$plan = $user->plan;
```

* Get user subscription
```
$subscription   = $user->subscription;
$expirationDate = $subscription->expires_at;
$userHasPaid    = $subscription->is_paid;
```

* Cancel subscription
```
$user->cancelSubscription();
```

* Renew subscription
```
$user->renewSubscription(true);
// The boolean stands for whether the user has already paid for the subscription or not
```
