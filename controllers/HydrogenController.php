<?php

namespace humhub\modules\hydrogen\controllers;

use humhub\components\Controller;
use humhub\modules\notification\models\Notification;
use humhub\modules\hydrogen\notifications\ChatNotification;
use Yii;

class HydrogenController extends Controller
{
    // public function actionNotif()
    // {
    //     Yii::$app->response->format = 'json';

    //     if (Notification::find()->where([
    //         'class' => ChatNotification::class,
    //         'user_id' => Yii::$app->user->getIdentity()->id,
    //         ])->andWhere(['!=', 'seen', '1'])->count() > 0)
    //     {
    //         return [];
    //     }

    //     ChatNotification::instance()->delete(Yii::$app->user->getIdentity());
    //     ChatNotification::instance()->setMessage(Yii::$app->request->post('name'))->send(Yii::$app->user->getIdentity());

    //     return [];
    // }
}

?>
