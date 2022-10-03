<?php

namespace humhub\modules\hydrogen;

use humhub\modules\hydrogen\widgets\HydrogenLoader;

class Events
{

    public static function onLayoutAddonsInit($event)
    {
        /** @var LayoutAddons $layoutAddons */
        $layoutAddons = $event->sender;
        $layoutAddons->addWidget(HydrogenLoader::class);
    }
}
