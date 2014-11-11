<?php

class RoomPicture extends Eloquent {

    protected $table = 'room_pictures';

    //columns that can be updated
    protected $fillable = array('title','url');

    //columns that can't be updated after assignment
    protected $guarded = array('id');

}
