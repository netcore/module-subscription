<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Menu;
use Netcore\Translator\Helpers\TransHelper;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $menuItems = [
            'leftAdminMenu' => [
                [
                    'name'            => 'Subscriptions',
                    'icon'            => 'fa fa-shopping-cart',
                    'type'            => 'url',
                    'value'           => '#',
                    'module'          => 'Subscription',
                    'is_active'       => 1,
                    'parameters'      => json_encode([]),
                    'active_resolver' => 'admin::subscriptions.*',
                    'children'        => [
                        [
                            'name'            => 'Billing periods',
                            'type'            => 'route',
                            'value'           => 'admin::subscriptions.periods.index',
                            'module'          => '',
                            'is_active'       => 1,
                            'active_resolver' => 'admin::subscriptions.periods.*',
                            'parameters'      => json_encode([])
                        ],
                        [
                            'name'            => 'Plans',
                            'type'            => 'route',
                            'value'           => 'admin::subscriptions.plans.index',
                            'module'          => '',
                            'is_active'       => 1,
                            'active_resolver' => 'admin::subscriptions.plans.*',
                            'parameters'      => json_encode([])
                        ],
                    ]
                ],
            ]
        ];

        foreach ($menuItems as $key => $items) {

            $menu = Menu::firstOrCreate([
                'key' => $key
            ]);

            $translations = [];

            foreach (TransHelper::getAllLanguages() as $language) {

                $translations[$language->iso_code] = [
                    'name' => ucwords(preg_replace(array('/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'), ' $0', $key))
                ];

            }

            $menu->updateTranslations($translations);

            foreach ($items as $item) {

                $row = $menu->items()->firstOrCreate(array_except($item, ['name', 'value', 'parameters', 'children']));
                $translations = [];

                foreach (TransHelper::getAllLanguages() as $language) {

                    $translations[$language->iso_code] = [
                        'name'       => $item['name'],
                        'value'      => $item['value'],
                        'parameters' => $item['parameters']
                    ];

                }

                $row->updateTranslations($translations);

                foreach ($item['children'] as $child) {

                    $child['menu_id'] = $menu->id;
                    $c = $row->children()->firstOrCreate(array_except($child, ['name', 'value', 'parameters']));
                    $translations = [];

                    foreach (TransHelper::getAllLanguages() as $language) {
                        $translations[$language->iso_code] = [
                            'name'       => $child['name'],
                            'value'      => $child['value'],
                            'parameters' => $child['parameters']
                        ];
                    }

                    $c->updateTranslations($translations);
                }

            }
        }

    }
}
