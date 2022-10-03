<?php

namespace humhub\modules\hydrogen\models;

use Yii;
use yii\base\Model;

/**
 * ConfigureForm defines the configurable fields.
 */
class ConfigureForm extends Model
{

    public $matrixServerUrl;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['matrixServerUrl', 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'matrixServerUrl' => Yii::t('HydrogenModule.base', 'Matrix server URL:'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'matrixServerUrl' => Yii::t('HydrogenModule.base', 'The Matrix server URL'),
        ];
    }

    public function loadSettings()
    {
        $this->matrixServerUrl = Yii::$app->getModule('hydrogen')->settings->get('matrixServerUrl');

        return true;
    }

    public function save()
    {
        Yii::$app->getModule('hydrogen')->settings->set('matrixServerUrl', $this->matrixServerUrl);

        return true;
    }

}
