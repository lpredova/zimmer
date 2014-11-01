<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

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

    public function user()
    {
        return $this->belongs_to('roles');
    }

}
