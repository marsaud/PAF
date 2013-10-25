<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-10-12 at 21:19:05.
 */
class PAF_Stream_PhpOutputTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PAF_Stream_PhpOutput
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new PAF_Stream_PhpOutput;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers PAF_Stream_PhpOutput::close
     */
    public function testClose()
    {
        $this->assertNull($this->object->close());
    }
    
    /**
     * @covers PAF_Stream_PhpOutput::startBuffer
     */
    public function testStartBuffer()
    {
        $object = new PAF_Stream_PhpOutput();
        $this->assertFalse($object->hasBuffer());
        $object->startBuffer();
        $this->assertTrue($object->hasBuffer());
        
        return $object;
    }
    
    /**
     * @covers PAF_Stream_PhpOutput::hasBuffer
     */
    public function testHasBuffer()
    {
        $string1 = 'This is not buffered.';
        $string2 = 'Neither is this.';
        
        $this->expectOutputString($string1 . $string2);
        
        $this->assertFalse($this->object->hasBuffer());
        $this->object->put($string1);
        
        $this->object->startBuffer();
        $this->assertTrue($this->object->hasBuffer());
        $this->object->put('This is buffered, so it does not break the output test.');
        
        $this->object->stopBuffer();
        $this->assertFalse($this->object->hasBuffer());
        $this->object->put($string2);
    }

    /**
     * @covers PAF_Stream_PhpOutput::dropBuffer
     * @todo   Implement testDropBuffer().
     */
    public function testDropBuffer()
    {
        $this->assertFalse($this->object->hasBuffer());
    }

    /**
     * @covers PAF_Stream_PhpOutput::flushBuffer
     * @todo   Implement testFlushBuffer().
     */
    public function testFlushBuffer()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers PAF_Stream_PhpOutput::getBuffer
     * @todo   Implement testGetBuffer().
     */
    public function testGetBuffer()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers PAF_Stream_PhpOutput::open
     * @todo   Implement testOpen().
     */
    public function testOpen()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }


    /**
     * @covers PAF_Stream_PhpOutput::get
     * @todo   Implement testGet().
     */
    public function testGet()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers PAF_Stream_PhpOutput::put
     * @todo   Implement testPut().
     */
    public function testPut()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers PAF_Stream_PhpOutput::_putDirect
     * @todo   Implement test_putDirect().
     */
    public function test_putDirect()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers PAF_Stream_PhpOutput::stopBuffer
     * @todo   Implement testStopBuffer().
     */
    public function testStopBuffer()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    

}
