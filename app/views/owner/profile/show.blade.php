@extends('owner.index')
@section('ownerContent')


            <a href="owner/profile/edit">Edit</a>
               <h4>Name    :{{($user->name)}}</h4>
               <h4>Surname    :{{($user->surname)}}</h4>
               <h4>Username    :{{($user->username)}}</h4>
               <h4>Email    :{{($user->email)}}</h4>
  @stop