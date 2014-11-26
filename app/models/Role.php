<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Role extends Eloquent{

    protected $table = 'roles';


    //columns that can be updated
    protected $fillable = array('name');

    //columns that can't be updated after assignment
    protected $guarded = array('id');


    public function users()
    {
        return $this->hasMany('User');
    }



}
