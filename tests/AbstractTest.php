<?php
namespace JClaveau\VisibilityViolator\Tests;

use PHPUnit\Framework\TestCase;

/**
 */
class AbstractTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
    }

    protected function setUp(): void
    {
        echo( get_called_class() . '::' . $this->getName() ."\n" );
    }

    /**/
}
