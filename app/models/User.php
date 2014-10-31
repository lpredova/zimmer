<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent/*Eloquent*/ implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	protected $table = 'users';

    //columns which we don't want to show
	protected $hidden = array('password', 'token');

    //columns that can be updated
    protected $fillable = array('name','surname','password','username','email','phone','avatar');

    //columns that can't be updated after assignment
    protected $guarded = array('id', 'role_id','created_at','token');

    //removing redundant data
    public $autoPurgeRedundantAttributes = true;

    public static $rules = array(
        'name' => 'required|min:3|max:80',
        'surname' => 'required|min:3|max:80',
        'username' => 'required|between:4,16',
        'email' => 'required|email',
        'password' => 'required|alpha_num|min:8|confirmed',
        'password_confirmation' => 'required|alpha_num|min:8',
    );


    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }



}
