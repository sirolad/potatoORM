<?php

require_once 'vendor/autoload.php';

use Sirolad\Potato;
use Sirolad\DB\DBConnect;
use Sirolad\Entities\Car;
use Sirolad\Entities\User;
use Sirolad\Entities\Motor;
use Sirolad\Entities\Bicycle;
use Sirolad\Libraries\Formatter;
use Sirolad\Libraries\TableMapper;
use Sirolad\Exceptions\EmptyTableException;
use Sirolad\Exceptions\RecordNotFoundException;
use Sirolad\Exceptions\TableDoesNotExistException;

#User Operations
//insert
// $user = new User();
// $user->login = "Dipo Dina";
// $user->password = md5("andelay");
// $user->age = 56;
// $g=$user->save();
// var_dump($g);

// $user = User::find(13);
// $user->login = "Ginger";
// $g=$user->save();
// var_dump($g);

// $user = User::destroy(13);

// var_dump($user);
//Update
// $user = User::where('login', 'JackBauer');
// $user->password = "wetina";
// $g = $user->save();
// var_dump($g);
//
// $user = User::getAll();
// print_r($user);

#Cars Operations
//Insert
// $car = new Car();
// $car->name = 'Nissan';
// $car->price = 90000;
// $car->year = 2005;
// $k = $car->save();
// var_dump($k);
// Print all
// $car = Car::getAll();
// print_r($car);
