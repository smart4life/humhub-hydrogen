<?php

namespace humhub\modules\hydrogen\notifications;

use humhub\modules\notification\components\BaseNotification;
use humhub\modules\notification\models\Notification;
use humhub\modules\user\models\User;

class ChatNotification extends BaseNotification
{
    public function __construct(
        protected $source = null,
        protected $originator = null,
        protected string $msg = ''
    ) {
        parent::__construct($source, $originator);
    }

    public function setMessage(string $msg): static
    {
        $this->msg = $msg;
        return $this;
    }

    public function send($user): bool
    {
        if (!($user instanceof User)) {
            return false;
        }

        // Create a new notification record in the database
        $notification = new Notification([
            'user_id' => $user->id,
            'class' => static::class,
            'seen' => 0,
            'title' => $this->msg,
            'module' => 'hydrogen',
        ]);

        // Save the notification to the database
        $notification->save();

        // Example: Log the notification message
        \Yii::info('Notification sent to user: ' . $user->username . ' Message: ' . $this->msg);

        // Return true/false based on success or failure of saving the notification
        return $notification->id !== null;
    }
}
