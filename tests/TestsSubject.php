<?php
namespace JClaveau\VisibilityViolator\Tests;

class TestsSubject
{
    protected $protected_property = 'protected_property_value';
    private   $private_property   = 'private_property_value';

    protected static $protected_static_property = 'protected_static_property_value';
    private   static $private_static_property   = 'private_static_property_value';

    /**
     */
    protected function protectedMethod()
    {
        return 'protectedMethod_return'
            .' with ['.implode(', ', func_get_args()).']';
    }

    /**
     */
    private function privateMethod()
    {
        return 'privateMethod_return'
            .' with ['.implode(', ', func_get_args()).']';
    }

    /**
     */
    protected static function protectedStaticMethod()
    {
        return 'protectedStaticMethod_return'
            .' with ['.implode(', ', func_get_args()).']';
    }

    /**
     */
    private static function privateStaticMethod()
    {
        return 'privateStaticMethod_return'
            .' with ['.implode(', ', func_get_args()).']';
    }

    /**/
}
