<?php

//require_once 'PAF/Stream/Interface.php';
//require_once 'PAF/Stream/PhpOutput.php';
//require_once 'PAF/View/Interface.php';
//require_once 'PAF/View/String.php';
//require_once 'PAF/Exception/Base.php';
//require_once 'PAF/Exception/NoSuchProperty.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-11-24 at 20:22:30.
 */
class PAF_View_StringTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PAF_View_String
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new PAF_View_String;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers PAF_View_Abstract::__construct
     * @covers PAF_View_Abstract::<protected>
     */
    public function testConstructor()
    {
        $stream = new PAF_Stream_PhpOutput();
        $object = new PAF_View_String('testConstructor', $stream);
        
        $this->assertSame($stream, $object->stream);
        $this->assertEquals('testConstructor', $object->content);
    }
    
    /**
     * @covers PAF_View_String::render
     * @covers PAF_View_Abstract::render
     * @dataProvider renderProvider
     */
    public function testRender($content)
    {
        $this->object->push($content);
        $this->expectOutputString($content);
        $this->object->render();
    }
    
    public function renderProvider()
    {
        $data = array();
        
        $data[] = array('');
        $data[] = array('a');
        $data[] = array('a' . PHP_EOL . 'b');
        
        return $data;
    }

    /**
     * @covers PAF_View_String::push
     * @dataProvider pushProvider
     */
    public function testPush($first, $second, $all)
    {
        $this->object->push($first);
        $this->assertEquals($first, $this->object->content);
        $this->object->push($second);
        $this->assertEquals($all, $this->object->content);
    }
    
    /**
     * @covers PAF_View_String::append
     * @dataProvider pushProvider
     */
    public function testAppend($first, $second, $all)
    {
        $this->object->append($first);
        $this->assertEquals($first, $this->object->content);
        $this->object->append($second);
        $this->assertEquals($all, $this->object->content);
    }
    
    public function pushProvider()
    {
        $data = array();
        
        $data[] = array('', 'a', 'a');
        $data[] = array('a', 'b', 'ab');
        $data[] = array('a', PHP_EOL . 'b', 'a' . PHP_EOL . 'b');
        
        return $data;
    }

    /**
     * @covers PAF_View_String::unshift
     * @dataProvider unshiftProvider
     */
    public function testUnshift($first, $second, $all)
    {
        $this->object->unshift($first);
        $this->assertEquals($first, $this->object->content);
        $this->object->unshift($second);
        $this->assertEquals($all, $this->object->content);
    }
    
    /**
     * @covers PAF_View_String::prepend
     * @dataProvider unshiftProvider
     */
    public function testPrepend($first, $second, $all)
    {
        $this->object->prepend($first);
        $this->assertEquals($first, $this->object->content);
        $this->object->prepend($second);
        $this->assertEquals($all, $this->object->content);
    }
    
    public function unshiftProvider()
    {
        $data = array();
        
        $data[] = array('', 'a', 'a');
        $data[] = array('a', 'b', 'ba');
        $data[] = array('a', 'b' . PHP_EOL, 'b' . PHP_EOL . 'a');
        
        return $data;
    }

    /**
     * @covers PAF_View_String::drop
     * @dataProvider dropProvider
     */
    public function testDrop($content)
    {
        $this->object->push($content);
        $this->assertEquals($content, $this->object->content);
        $this->object->drop();
        $this->assertEquals('', $this->object->content);
    }
    
    public function dropProvider()
    {
        $data = array();
        
        $data[] = array('');
        $data[] = array('a');
        $data[] = array('a' . PHP_EOL . 'b');
        
        return $data;
    }

    /**
     * @covers PAF_View_String::__get
     * @dataProvider __getProvider
     */
    public function test__get($content)
    {
        $this->object->push($content);
        $this->assertEquals($content, $this->object->content);
    }
    
    public function test__getException()
    {
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->anyUnexistingProperty;
    }
    
    public function __getProvider()
    {
        return $this->renderProvider();
    }

    /**
     * @covers PAF_View_String::__toString
     * @dataProvider __toStringProvider
     */
    public function test__toString($content)
    {
        $this->object->push($content);
        $this->assertEquals($content, $this->object->__toString());
        $this->assertEquals($content, (string) $this->object);
    }
    
    public function __toStringProvider()
    {
        return $this->renderProvider();
    }

}
