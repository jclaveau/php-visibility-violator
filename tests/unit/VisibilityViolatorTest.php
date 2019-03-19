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

    /**/
}
