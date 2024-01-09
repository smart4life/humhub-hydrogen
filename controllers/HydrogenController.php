<?php

namespace humhub\modules\hydrogen\controllers;

use humhub\components\Controller;
use humhub\modules\notification\models\Notification;
use humhub\modules\hydrogen\notifications\ChatNotification;
use Yii;

class HydrogenController extends Controller
{
    public function actionNotif()
    {
        Yii::$app->response->format = 'json';

        // Ensure the user is logged in
        if (Yii::$app->user->isGuest) {
            return ['error' => 'User is not logged in'];
        }

        try {
            $userIdentity = Yii::$app->user->getIdentity();

            // Ensure the identity exists and has an 'id' property
            $userId = $userIdentity->id ?? '';

            // Check if userId is not empty
            if ($userId !== '') {
                // Check for unread notifications
                $unreadNotificationsCount = Notification::find()
                    ->where([
                        'class' => ChatNotification::class,
                        'user_id' => $userId,
                    ])->andWhere(['!=', 'seen', '1'])
                    ->count();

                if ($unreadNotificationsCount === 0) {
                    return ['message' => 'No unread notifications'];
                }

                // Hard delete existing notifications
                ChatNotification::instance()->hardDelete($userIdentity);

                // Create and send a new notification
                ChatNotification::instance()
                    ->setMessage(Yii::$app->request->post('name'))
                    ->send($userIdentity);

                return ['message' => 'Notification sent successfully'];
            }
        } catch (\Exception $e) {
            return ['error' => 'An error occurred: ' . $e->getMessage()];
        }

        return ['error' => 'Unable to process notification'];
    }
}

