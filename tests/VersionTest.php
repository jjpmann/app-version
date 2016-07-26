<?php

namespace AppVersion;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testClassCreate()
    {
        $v = new Version();
        $this->assertInstanceOf('AppVersion\Version', $v);
    }
}
