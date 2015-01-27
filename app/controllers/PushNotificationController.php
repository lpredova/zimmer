<?php

class PushController extends BaseController
{
    /**
     * Method that sends push notification with tnx msg after registration
     * @param $id
     */
    public function sendThanks($id)
    {
        $message = json_encode(['title' => 'Thank you', 'message' => 'Keep exploring with Zimmer Frei']);
        $user = User::find($id);
        if ($user->gcm_phone_id) {
            PushNotification::app('appNameAndroid')
                ->to($user->gcm_phone_id)
                ->send($message);
        }
    }


    /**
     * Method that sends push notifications to all users that have registrated
     * @param $title
     * @param $message
     */
    public function sendToEverybody($title, $message)
    {

        $message = json_encode(['title' => $title, 'message' => $message]);
        $users = User::all();

        foreach ($users as $user) {
            if ($user->gcm_phone_id) {
                PushNotification::app('appNameAndroid')
                    ->to($user->gcm_phone_id)
                    ->send($message);
            }
        }
        Session::flash('success', 'Notification sent to all users');
    }
}