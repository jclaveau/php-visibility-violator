<?php
namespace JClaveau\VisibilityViolator\Tests;

use JClaveau\VisibilityViolator\VisibilityViolator;

class VisibilityViolatorTest extends AbstractTest
{
    public function provider_getHiddenProperty()
    {
        return [
            'protected_property' => [
                new TestsSubject, 
                'protected_property', 
                'protected_property_value',
            ],
            'private_property' => [
                new TestsSubject, 
                'private_property', 
                'private_property_value',
            ],
            'protected_static_property' => [
                TestsSubject::class, 
                'protected_static_property', 
                'protected_static_property_value',
            ],
            'private_static_property' => [
                TestsSubject::class, 
                'private_static_property', 
                'private_static_property_value',
            ],
        ];
    }
    
    /**
     * @dataProvider provider_getHiddenProperty
     */
    public function test_getHiddenProperty($class_or_instance, $property, $value)
    {
        $this->assertEquals(
            $value,
            VisibilityViolator::getHiddenProperty($class_or_instance, $property)
        );
    }

    public function provider_setHiddenProperty()
    {
        return [
            'protected_property' => [
                new TestsSubject, 
                'protected_property', 
                'protected_property_changed_value',
            ],
            'private_property' => [
                new TestsSubject, 
                'private_property', 
                'private_property_changed_value',
            ],
            'protected_static_property' => [
                TestsSubject::class, 
                'protected_static_property', 
                'protected_static_property_changed_value',
            ],
            'private_static_property' => [
                TestsSubject::class, 
                'private_static_property', 
                'private_static_property_changed_value',
            ],
        ];
    }
    
    /**
     * @dataProvider provider_setHiddenProperty
     */
    public function test_setHiddenProperty($class_or_instance, $property, $value)
    {
        VisibilityViolator::setHiddenProperty($class_or_instance, $property, $value);
        $this->assertEquals(
            $value,
            VisibilityViolator::getHiddenProperty($class_or_instance, $property)
        );
    }

    public function provider_callHiddenMethod()
    {
        return [
            'protected_property' => [
                new TestsSubject, 
                'protectedMethod', 
                ['argument'],
                'protectedMethod_return',
            ],
            'private_property' => [
                new TestsSubject, 
                'privateMethod', 
                ['argument'],
                'privateMethod_return',
            ],
            'protected_static_property' => [
                TestsSubject::class, 
                'protectedStaticMethod', 
                ['argument'],
                'protectedStaticMethod_return',
            ],
            'private_static_property' => [
                TestsSubject::class, 
                'privateStaticMethod', 
                ['argument'],
                'privateStaticMethod_return',
            ],
        ];
    }
    
    /**
     * @dataProvider provider_callHiddenMethod
     */
    public function test_callHiddenMethod($class_or_instance, $method, $arguments, $value)
    {
        $this->assertEquals(
            $value.' with ['.implode(', ', $arguments).']',
            VisibilityViolator::callHiddenMethod($class_or_instance, $method, $arguments)
        );
    }

    public function provider_extractClassNameAndObject()
    {
        return [
            'existing_instance' => [
                $instance = new TestsSubject, 
                [TestsSubject::class, $instance], 
            ],
            'existing_class' => [
                TestsSubject::class, 
                [TestsSubject::class, null], 
            ],
        ];
    }
    
    /**
     * @dataProvider provider_extractClassNameAndObject
     */
    public function test_extractClassNameAndObject($class_or_instance, array $extracted_class_and_instance)
    {
        $this->assertEquals(
            $extracted_class_and_instance,
            VisibilityViolator::callHiddenMethod(
                VisibilityViolator::class,
                'extractClassNameAndObject',
                [$class_or_instance]
            )
        );
    }

    public function provider_extractClassNameAndObject_invalid()
    {
        return [
            'non_existing_class' => [
                'choubidoubidouwa!', 
                "The provided class name corresponds to no defined class: 'choubidoubidouwa!'", 
            ],
            'neither_a_string_either_an_instance' => [
                8, 
                '$objectOrClassName must be an instance or a class name including its namespace instead of 8', 
            ],
        ];
    }
    
    /**
     * @dataProvider provider_extractClassNameAndObject_invalid
     */
    public function test_extractClassNameAndObject_invalid($invalid_class_or_instance, $exception_message)
    {
        try {
            VisibilityViolator::callHiddenMethod(
                VisibilityViolator::class,
                'extractClassNameAndObject',
                [$invalid_class_or_instance]
            );
            $this->assertTrue(false, 'an error should have been thrown here');
        }
        catch (\Exception $e) {
            $this->assertEquals(
                $exception_message,
                $e->getMessage()
            );
        }
    }

    /**/
}
