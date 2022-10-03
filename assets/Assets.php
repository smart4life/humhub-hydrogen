<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\hydrogen\assets;

use Yii;
use humhub\components\assets\AssetBundle;

class Assets extends AssetBundle
{
    public $sourcePath = '@hydrogen/resources/';

    public $forceCopy = true;

    public $jsOptions = ['position' => \yii\web\View::POS_END, 'type' => 'module'];

    public $cssOptions = ['position' => \yii\web\View::POS_END];

    public $js = [
        // 'js/humhub.hydrogen.js',
        'assets/index.js',
    ];

    public $css = [
        // 'humhub-hydrogen.css',
        'assets/index.css',
    ];

    // /**
    //  * @param View $view
    //  * @return AssetBundle
    //  */
    // public static function register($view)
    // {
    //     $module = Yii::$app->getModule('hydrogen');

    //     $settings = $module->settings;

    //     $view->registerJsConfig([
    //         'hydrogen' => [
    //             'hydrogenPath' => $settings->get('hydrogenPath', ''),
    //             'pullingInterval' => (int)$settings->get('pullingInterval', 10),
    //         ],
    //     ]);
    //     return parent::register($view);
    // }
}
