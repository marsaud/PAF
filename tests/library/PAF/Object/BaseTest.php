<?php

//require_once dirname(__FILE__) . '/../../../../library/PAF/Object/Base.php';
//require_once dirname(__FILE__) . '/../../../../library/PAF/Exception/Base.php';
//require_once dirname(__FILE__) . '/../../../../library/PAF/Exception/NoSuchProperty.php';
//require_once dirname(__FILE__) . '/../../../../library/PAF/Exception/NoSuchIdentifier.php';
//require_once dirname(__FILE__) . '/../../../../library/PAF/Exception/BrokenProperty.php';

/**
 * A sub-type that de-encapsulate a bit the data so we can verify state.
 *
 * @property mixed $readWriteAttribute
 * @property mixed $readWriteMethod
 * @property mixed $brokenProperty
 * @property-read mixed $readAttribute
 * @property-read mixed $readMethod
 * @property-write mixed $writeAttribute
 * @property-write mixed $writeMethod
 *
 */
class TestObjectBase extends PAF_Object_Base
{

    const FORBIDDEN = 'forbidden';

    protected function _initProperties()
    {
        $this->_extendProperties(array(
            'readWriteAttribute' => 'rwa',
            'readWriteMethod' => 'rwm',
            'brokenProperty' => 'broken'
        ));
        $this->_extendReadProperties(array(
            'readAttribute' => 'ra',
            'readMethod' => 'rm'
        ));
        $this->_extendWriteProperties(array(
            'writeAttribute' => 'wa',
            'writeMethod' => 'wm'
        ));
    }

    /**
     *
     * @var mixed
     */
    protected $_rwa, $_rwm, $_ra, $_rm, $_wa, $_wm;

    protected function _getRwm()
    {
        return $this->_rwm;
    }

    protected function _setRwm($value)
    {
        if (self::FORBIDDEN === $value)
        {
            throw new TestException();
        }
        $this->_rwm = $value;
    }

    protected function _getRm()
    {
        return $this->_rm;
    }

    protected function _setWm($value)
    {
        if (self::FORBIDDEN === $value)
        {
            throw new TestException();
        }
        $this->_wm = $value;
    }

    public function verifiyWriteOnlyAttribute()
    {
        return $this->_wa;
    }

    public function verifyWriteOnlyMethod()
    {
        return $this->_wm;
    }

    public function assignReadOnlyAttribute($value)
    {
        $this->_ra = $value;
    }

    public function assignReadOnlyMethod($value)
    {
        $this->_rm = $value;
    }

}

class TestException extends Exception
{
    
}

/**
 * Test class for PAF_Object_Base.
 * Generated by PHPUnit on 2012-07-17 at 19:08:31.
 */
class PAF_Object_BaseTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var TestObjectBase
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TestObjectBase();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    public function valueProvider()
    {
        $data = array();

        $data[] = array(true);
        $data[] = array(1);
        $data[] = array(1.1);
        $data[] = array('1');
        $data[] = array('abc');
        $data[] = array(new stdClass);

        return $data;
    }

    public function errorProvider()
    {
        $data = array();

        $data[] = array(TestObjectBase::FORBIDDEN);

        return $data;
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('PAF_Object_Base', new TestObjectBase());
    }

    /**
     * @dataProvider valueProvider
     * 
     * @covers PAF_Object_Base::__set
     * @covers PAF_Object_Base::__get
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testReadWriteAttribute($value)
    {
        $this->object->readWriteAttribute = $value;
        $this->assertEquals($value, $this->object->readWriteAttribute);
    }

    /**
     * @dataProvider valueProvider
     * 
     * @covers PAF_Object_Base::__set
     * @covers PAF_Object_Base::__get
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testReadWriteMethod($value)
    {
        $this->object->readWriteMethod = $value;
        $this->assertEquals($value, $this->object->readWriteMethod);
    }

    /**
     * @dataProvider errorProvider
     * 
     * @covers PAF_Object_Base::__set
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testReadWriteMethodException($value)
    {
        $this->setExpectedException('TestException');
        $this->object->readWriteMethod = $value;
    }

    /**
     * @dataProvider valueProvider
     * 
     * @covers PAF_Object_Base::__set
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testWriteOnlyAttribute($value)
    {
        $this->object->writeAttribute = $value;
        $this->assertEquals($value, $this->object->verifiyWriteOnlyAttribute());
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->writeAttribute;
    }

    /**
     * @dataProvider valueProvider
     * 
     * @covers PAF_Object_Base::__set
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testWriteOnlyMethod($value)
    {
        $this->object->writeMethod = $value;
        $this->assertEquals($value, $this->object->verifyWriteOnlyMethod());
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->writeMethod;
    }

    /**
     * @dataProvider errorProvider
     * @covers PAF_Object_Base::__set
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testWriteMethodException($value)
    {
        $this->setExpectedException('TestException');
        $this->object->writeMethod = $value;
    }

    /**
     * @dataProvider valueProvider
     * @covers PAF_Object_Base::__get
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testReadAttribute($value)
    {
        $this->object->assignReadOnlyAttribute($value);
        $this->assertEquals($value, $this->object->readAttribute);
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->readAttribute = $value;
    }

    /**
     * @dataProvider valueProvider
     * @covers PAF_Object_Base::__get
     * @covers PAF_Object_Base::<private>
     * @covers PAF_Object_Base::<protected>
     */
    public function testReadMethod($value)
    {
        $this->object->assignReadOnlyMethod($value);
        $this->assertEquals($value, $this->object->readMethod);
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->readMethod = $value;
    }

    public function testException1()
    {
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->noWriteProperty = 'any';
    }

    public function testException2()
    {
        $this->setExpectedException('PAF_Exception_NoSuchProperty');
        $this->object->noReadProperty;
    }

    public function testException3()
    {
        $this->setExpectedException('PAF_Exception_BrokenProperty');
        $this->object->brokenProperty = 'any';
    }

    public function testException4()
    {
        $this->setExpectedException('PAF_Exception_BrokenProperty');
        $this->object->brokenProperty;
    }

}
