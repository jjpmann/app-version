<?php

namespace AppVersion\Command;

class ValidateCommandTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testClassCreate()
    {
        $v = new ValidateCommand();
        $this->assertInstanceOf('AppVersion\Command\ValidateCommand', $v);
    }
}