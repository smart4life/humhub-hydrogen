<?php

use humhub\modules\hydrogen\assets\Assets;

// Check if the module 'hydrogen' exists before accessing its settings
$hydrogenModule = Yii::$app->getModule('hydrogen');
$matrixServerUrl = '';
if ($hydrogenModule) {
    $matrixServerUrl = $hydrogenModule->settings->get('matrixServerUrl');
}

Assets::register($this);

$this->registerJsConfig('hydrogen', ['matrixServerUrl' => $matrixServerUrl]);
?>

<div id="hydrogen" class="hydrogen"></div>
