# PotatoORM

[![Build Status](https://travis-ci.org/andela-sakande/potatoORM.svg)](https://travis-ci.org/andela-sakande/potatoORM)

This package aims to provide an analysis based on the number of open source
projects an individual possess on Github. It ranks the individual based on the number
of repositories as folows :

`>= 5 and <= 10        Junior Evangelist`

`>= 11 and <= 20       Associate Evangelist`

`>= 21                 Most Senior Evangelist`

DIRECTORY STRUCTURE
-------------------

```
src/           core package code
   |DB         database connection class
   |Entities   samples class to test the model class
   |Exceptions custom exception classes
   |Libraries  helper classes
tests/         tests of the core package
```

## Installation

[PHP](https://php.net) 5.5+ and [Composer](https://getcomposer.org) are required.

Via Composer

``` bash
$ composer install sirolad/open-source-evangelist-agnostic-package
```

``` bash
$ composer install
```

## Usage
```
$user = User::getAll();
print_r($user) ​
// should print out all the ​
users ​ in the ​
User ​ table.
$car = Car::getAll();
print_r($car) ​
// should print out all the ​
cars ​ in the ​
Car ​ table.
$bicycle = Bicycle::getAll();
print_r($bicycle) ​
// should print out all the ​
bicycles ​ in the ​
Bicycle
table.
```
## Change log

Please check out [CHANGELOG](CHANGELOG.md) file for information on what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit test
```

``` composer
$ composer test
```

## Contributing

Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.

## Credits

Open-source Evangelist is developed and maintained by `Surajudeen Akande`.

## License

Open-source Evangelist is released under the MIT Licence. See the bundled [LICENSE](LICENSE.md) file for details.