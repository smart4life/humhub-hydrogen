<?php

// use humhub\libs\Html;

// $assets = humhub\modules\hydrogen\assets\Assets::register($this);
$this->registerJsConfig('hydrogen', ['matrixServerUrl' => Yii::$app->getModule('hydrogen')->settings->get('matrixServerUrl')]);
?>

<div id="hydrogen" class="hydrogen"></div>
