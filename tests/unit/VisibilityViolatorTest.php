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

    /**/
}
