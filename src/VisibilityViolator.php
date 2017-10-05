<?php
namespace JClaveau\VisibilityViolator;

/**
 * This class provides tools to overpass visibility of methods, properties or
 * constants.
 *
 * It is meant to be used during tests.
 */
class VisibilityViolator
{
    /**
     * Retruns the value of a private property of the owner.
     *
     * @param $name the name of the property
     * @return the value of the property
     */
    public static function getPrivateProperty($object, $name)
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $reflectionProperty = $reflectionClass->getProperty($name);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }

    /**
     * Sets the value of a private property.
     *
     * @param name of the private property
     * @param value the new value
     */
    public static function setPrivateProperty($object, $name, $value)
    {
        self::setPrivatePropertyForClass($object, get_class($object), $name, $value);
    }

    /**
     * Sets the value of a private property.
     *
     * @param name of the private property
     * @param value the new value
     */
    public static function setPrivatePropertyForClass($object, $class, $name, $value)
    {
        $reflectionClass = new \ReflectionClass($class);
        $reflectionProperty = $reflectionClass->getProperty($name);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }

    /**
     * Calls a private method of the owner.
     *
     * @param  $name        : the name of the method
     * @param  $arguments   : an array of arguments for the method call
     * @return mixed        : the returned value of the method
     */
    public static function callPrivateMethod($object, $name, $arguments=array())
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $reflectionMethod = $reflectionClass->getMethod($name);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invokeArgs($object, $arguments);
    }

    /**
     * Calls a static private method of a class.
     *
     * @param  $className   : the name of the class
     * @param  $name        : the name of the static privat method
     * @param  $arguments   : the arguments to use during the method call
     * @return mixed        : the returned value of the method
     */
    public static function callPrivateStaticMethod($className, $name, $arguments=array())
    {
        $reflectionClass = new \ReflectionClass( $className );
        $reflectionMethod = $reflectionClass->getMethod( $name );
        $reflectionMethod->setAccessible( true );
        return $reflectionMethod->invokeArgs( null, $arguments );
    }

    /**/
}
