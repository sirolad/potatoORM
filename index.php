<?php

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

class User extends Potato
{

}

$user = new User();
$user->login = "Terryd";
$user->password = "password";
$user->age = 34;
$user->save();
