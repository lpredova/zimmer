<?php

class PushController extends BaseController {

    public function sendThanks($id){
        $message=json_encode(['title'=>'Thank you','message'=>'Every drop counts. You are true hero.']);
        $user=User::find($id);
        if($user->gcm_regid){
            PushNotification::app('appNameAndroid')
                ->to($user->gcm_regid)
                ->send($message);
            Session::flash('success','Notification sent');
            return Redirect::back();
        }else{
            Session::flash('error','User does not have required data');
            return Redirect::back();
        }
    }
    public function sendInviteToEvent($id,$event){
        $event=Bloodevent::find($event);
        $message=json_encode(['title'=>'Event started','message'=>'Donate blood and share life in '.$event->location]);
        $user=User::find($id);
        if($user->gcm_regid){
            PushNotification::app('appNameAndroid')
                ->to($user->gcm_regid)
                ->send($message);
            Session::flash('success','Notification sent');
            return  Redirect::back();
        }else{
            Session::flash('error','User does not have required data');
            return  Redirect::back();
        }
    }
    public function isEligible($id){
        $message=json_encode(['title'=>'Notification','message'=>'You can donate blood again']);
        $user=User::find($id);
        if($user->gcm_regid){
            PushNotification::app('appNameAndroid')
                ->to($user->gcm_regid)
                ->send($message);
            Session::flash('success','Notification sent');
            return Redirect::back();
        }else{
            Session::flash('error','User does not have required data');
            return  Redirect::back();
        }
    }
}