<?php
namespace JClaveau\VisibilityViolator;

/**
 * This class provides tools to overpass visibility of methods, properties or
 * constants.
 *
 * It is meant to be used during tests.
 *
 * @todo constants
 */
class VisibilityViolator
{
    /**
     *
     */
    private function extractClassNameAndObject($objectOrClassName)
    {
        if (is_object($objectOrClassName)) {
            $object    = $objectOrClassName;
            $className = get_class($objectOrClassName);
        }
        elseif (is_string($objectOrClassName)) {
            if (!class_exists($objectOrClassName)) {
                throw new \InvalidArgumentException(
                    "The provided class name corresponds to no defined class: '$objectOrClassName'"
                );
            }
            else {
                $className = $objectOrClassName;
            }

            $object = null;
        }
        else {
            throw new \InvalidArgumentException(
                "\$objectOrClassName must be an instance or a class name including its namespace"
            );
        }

        return [
            $className,
            $object
        ];
    }

    /**
     * Retruns the value of a private or protected property from a static class
     * or an object.
     *
     * @param $name the name of the property
     * @return the value of the property
     */
    public static function getHiddenProperty($objectOrClassName, $name)
    {
        list($className, $object) = self::extractClassNameAndObject($objectOrClassName);

        $reflectionClass    = new \ReflectionClass($className);
        $reflectionProperty = $reflectionClass->getProperty($name);
        $reflectionProperty->setAccessible(true);

        $value = $object
               ? $reflectionProperty->getValue($object)
               : $reflectionProperty->getValue();

        return $value;
    }

    /**
     * Sets the value of a private or protected property.
     *
     * @param name of the private property
     * @param value the new value
     */
    public static function setHiddenProperty($objectOrClassName, $name, $value)
    {
        list($className, $object) = self::extractClassNameAndObject($objectOrClassName);

        $reflectionClass    = new \ReflectionClass($className);
        $reflectionProperty = $reflectionClass->getProperty($name);
        $reflectionProperty->setAccessible(true);

        if ($object)
            $reflectionProperty->setValue($object, $value);
        else
            $reflectionProperty->setValue($value);
    }

    /**
     * Calls a private method of the owner.
     *
     * @param  $name        : the name of the method
     * @param  $arguments   : an array of arguments for the method call
     * @return mixed        : the returned value of the method
     */
    public static function callHiddenMethod($objectOrClassName, $name, $arguments=[])
    {
        list($className, $object) = self::extractClassNameAndObject($objectOrClassName);

        $reflectionClass  = new \ReflectionClass(get_class($object));
        $reflectionMethod = $reflectionClass->getMethod($name);
        $reflectionMethod->setAccessible(true);

        $reflectionMethod->invokeArgs($object, $arguments);
    }

    /**/
}
