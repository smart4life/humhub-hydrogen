<?php

use humhub\modules\hydrogen\Events;
use humhub\modules\hydrogen\Module;
use humhub\widgets\LayoutAddons;

return [
    'id' => 'hydrogen',
    'class' => Module::class,
    'namespace' => 'humhub\modules\hydrogen',
    'events' => [
        ['class' => LayoutAddons::class, 'event' => LayoutAddons::EVENT_INIT, 'callback' => [Events::class, 'onLayoutAddonsInit']],
    ],
];
