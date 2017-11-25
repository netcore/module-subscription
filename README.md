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
php artisan module:seed Subscription
php artisan migrate
```
