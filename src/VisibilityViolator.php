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
     * @param  string|object $objectOrClassName  The name of the class or the instance
     * @return array
     */
    private static function extractClassNameAndObject($objectOrClassName)
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
                ." instead of ".var_export($objectOrClassName, true)
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
     * @param  string|object $objectOrClassName  The name of the class or the instance
     * @param  string        $name               The name of the property
     * @return mixed                             The value of the property
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
     * @param string|object $objectOrClassName  The name of the class or the instance
     * @param string        $name               The name of the private property
     * @param mixed         $value              The new value
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
     * @param  string|object $objectOrClassName The name of the class or the instance
     * @param  string        $name              The name of the method
     * @param  array         $arguments         An array of arguments for the method call
     * @return mixed                            The returned value of the method
     */
    public static function callHiddenMethod($objectOrClassName, $name, array $arguments=[])
    {
        list($className, $object) = self::extractClassNameAndObject($objectOrClassName);

        $reflectionClass  = new \ReflectionClass($className);
        $reflectionMethod = $reflectionClass->getMethod($name);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod->invokeArgs($object, $arguments);
    }

    /**/
}
