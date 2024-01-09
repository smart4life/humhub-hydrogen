<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\hydrogen\widgets;

use humhub\components\Widget;
use humhub\modules\hydrogen\assets\Assets;


/**
 * Class HydrogenLoader
 * @package humhub\modules\hydrogen\widgets
 */
class HydrogenLoader extends Widget
{

    public function run() {

        Assets::register($this->view);
        return $this->render('footer', []);
    }

}
