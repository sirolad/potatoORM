<?php

require_once 'vendor/autoload.php';

use Sirolad\Potato\Potato;
use Sirolad\Potato\User;
use Sirolad\Potato\Car;
use Sirolad\Potato\DB\DBConnect;
use Sirolad\Potato\Libraries\Formatter;
use Sirolad\Potato\Libraries\TableMapper;
use Sirolad\Potato\Exceptions\EmptyTableException;
use Sirolad\Potato\Exceptions\RecordNotFoundException;
use Sirolad\Potato\Exceptions\TableDoesNotExistException;

//insert
// $user = new User();
// $user->login = "Jackbauer";
// $user->password = "password";
// $user->age = 34;
// $g=$user->save();
// var_dump($g);

// $user = User::find(13);
// $user->login = "Ginger";
// $user->save();
// var_dump($g);

// $user = User::destroy(11);

// var_dump($user);
//Update
// $user = User::where('login', 'Jackbauer');
// $user->password = "wetin";
// $g = $user->save();
// var_dump($g);
//
// $user = User::getAll();
// print_r($user);
