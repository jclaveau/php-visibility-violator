PHP Visibility Violator
=============================

This class provides simple helpers uppon basic features of the [Reflection API](https://secure.php.net/manual/en/book.reflection.php) to violate the [visibility](http://php.net/manual/en/language.oop5.visibility.php) of properties and methods:

+ Modify or access privates properties of classes and instances, 
+ Call privates or protected methods 

## Quality
[![Build Status](https://travis-ci.org/jclaveau/php-logical-filter.png?branch=master)](https://travis-ci.org/jclaveau/php-visibility-violator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jclaveau/php-visibility-violator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jclaveau/php-visibility-violator/?branch=master)
[![codecov](https://codecov.io/gh/jclaveau/php-visibility-violator/branch/master/graph/badge.svg)](https://codecov.io/gh/jclaveau/php-visibility-violator)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/jclaveau/php-visibility-violator/issues)
[![Viewed](http://hits.dwyl.com/jclaveau/php-visibility-violator.svg)](http://hits.dwyl.com/jclaveau/php-visibility-violator)

## Installation
The Visibility Violator is available via composer

```
composer require jclaveau/php-visibility-violator
```

## Usage

```php
$value = VisibilityViolator::getHiddenProperty($instance, $property);
$value = VisibilityViolator::getHiddenProperty(MyClass::class, $static_property);

VisibilityViolator::setHiddenProperty($instance, $property, 'new value');
VisibilityViolator::setHiddenProperty(MyClass::class, $static_property, 'new value');

$return = VisibilityViolator::callHiddenMethod($instance, $method, $arguments);
$return = VisibilityViolator::callHiddenMethod(MyClass::class, $static_method, $arguments);
```

## Documentation
+ [API Reference](docs)
+ [PHP Visibility Documentation](http://php.net/manual/en/language.oop5.visibility.php)
+ [PHP Reflection Documentation](https://secure.php.net/manual/en/book.reflection.php)
+ [Tests](tests/unit/VisibilityViolatorTest.php)
