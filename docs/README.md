# PHP Logical Filter

## Table of Contents

* [VisibilityViolator](#visibilityviolator)
    * [getHiddenProperty](#gethiddenproperty)
    * [setHiddenProperty](#sethiddenproperty)
    * [callHiddenMethod](#callhiddenmethod)

## VisibilityViolator

This class provides tools to overpass visibility of methods, properties or
constants.

It is meant to be used during tests.

* Full name: \JClaveau\VisibilityViolator\VisibilityViolator


### getHiddenProperty

Retruns the value of a private or protected property from a static class
or an object.

```php
VisibilityViolator::getHiddenProperty( string|object $objectOrClassName, string $name ): mixed
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$objectOrClassName` | **string&#124;object** | The name of the class or the instance |
| `$name` | **string** | The name of the property |


**Return Value:**

The value of the property



---

### setHiddenProperty

Sets the value of a private or protected property.

```php
VisibilityViolator::setHiddenProperty( string|object $objectOrClassName, string $name, mixed $value )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$objectOrClassName` | **string&#124;object** | The name of the class or the instance |
| `$name` | **string** | The name of the private property |
| `$value` | **mixed** | The new value |




---

### callHiddenMethod

Calls a private method of the owner.

```php
VisibilityViolator::callHiddenMethod( string|object $objectOrClassName, string $name, array $arguments = array() ): mixed
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$objectOrClassName` | **string&#124;object** | The name of the class or the instance |
| `$name` | **string** | The name of the method |
| `$arguments` | **array** | An array of arguments for the method call |


**Return Value:**

The returned value of the method



---



--------
> This document was automatically generated from source code comments on 2019-03-20 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
