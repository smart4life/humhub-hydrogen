<?php

namespace humhub\modules\hydrogen;

use yii\helpers\Url;

/**
 * @inheritdoc
 */
class Module extends \humhub\components\Module
{
    /**
     * @var array contains all available icon aliases
     */
    public $iconAlias = [
        'hydrogen' => 'comments'
    ];

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to([
            '/hydrogen/admin'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

    /**
     * @param $name
     * @return string|null
     */
    public function getIconAlias($name)
    {
        // Use null coalescing operator to provide a default value
        return $this->iconAlias[$name] ?? $name;
    }

}
