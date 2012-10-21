<?php

require_once dirname(__FILE__) .
    '/../../../../library/PAF/Controller/Abstract.php';

class TestControllerAbstract extends PAF_Controller_Abstract
{

    public function actionForTest($param1, $param2, $param3)
    {
        $args = func_get_args();
        array_unshift($args, __METHOD__);
        echo implode('-', $args);
    }

}

class TestControllerMockView implements PAF_View_Interface
{
    public function render()
    {

    }
}

class TestControllerMockContainer implements PAF_Container_Interface
{
    public function get($resourceName)
    {

    }
}

/**
 * Test class for PAF_Controller_Abstract.
 * Generated by PHPUnit on 2012-07-22 at 22:24:26.
 */
class PAF_Controller_AbstractTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PAF_Controller_Abstract
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TestControllerAbstract();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testConstructor()
    {
        $this->assertInstanceOf('PAF_Controller_Abstract', new TestControllerAbstract());
    }

    /**
     * @covers PAF_Controller_Abstract::doAction
     * @covers PAF_Controller_Abstract::<protected>
     * @covers PAF_Controller_Abstract::<private>
     * @todo Implement testDoAction().
     */
    public function testDoAction()
    {
        $this->expectOutputString(
            'TestControllerAbstract::actionForTest-a-b-c'
        );

        $this->object->doAction('actionForTest', 'a', 'b', 'c');
    }

    /**
     * @dataProvider illegalActionProvider
     */
    public function testDoActionException1($actionName)
    {
        $this->setExpectedException('PAF_Exception_IllegalArgument');
        $this->object->doAction($actionName);
    }

    public function illegalActionProvider()
    {
        $data = array();

        $data[] = array('doAction');
        $data[] = array('_');
        $data[] = array('_a');

        return $data;
    }

    public function testDoActionException2()
    {
        $this->setExpectedException('PAF_Exception_NoSuchAction');
        $this->object->doAction('unexistingAction');
    }

    public function testViewProperty()
    {
        $view = new TestControllerMockView();

        $this->object->view = $view;
        $this->assertEquals($view, $this->object->view);
    }

    public function testContainerProperty()
    {
        $container = new TestControllerMockContainer();

        $this->object->container = $container;
        $this->assertEquals($container, $this->object->container);
    }
}
