<?php namespace Paul\Patreon;
require __DIR__ . '/vendor/autoload.php';

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
      return [
        'Paul\Patreon\Components\Goal' => 'Goal'
      ];
    }

    public function registerSettings()
    {
      return [
        'settings' => [
            'label'       => 'Patreon Settings',
            'description' => 'Set your patreon client_id and api_key',
            'icon'        => 'icon-money',
            'class'       => 'Paul\Patreon\Models\Settings',
            'order'       => 0,
            'keywords'    => 'security location',
            'permissions' => ['paul.patreon.access_settings']
        ]
    ];
    }
}
