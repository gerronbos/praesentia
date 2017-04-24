<?php namespace model;

class Users extends model{
    protected $table = 'users';
    protected $protected = ['password'];
}
?>