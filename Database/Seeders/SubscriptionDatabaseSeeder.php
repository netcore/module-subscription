<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PeriodsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PlansTableSeeder::class);
    }
}
