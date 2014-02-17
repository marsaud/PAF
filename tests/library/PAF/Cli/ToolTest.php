<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-02-14 at 20:54:56.
 */
class PAF_Cli_ToolTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PAF_Cli_Tool
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new PAF_Cli_Tool;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers PAF_Cli_Tool::structureArguments
     * @covers PAF_Cli_Tool::<private>
     * @dataProvider structureArgumentsProvider
     */
    public function testStructureArguments($input, $expected)
    {
        $this->assertEquals($expected, $this->object->structureArguments($input));
    }

    public function structureArgumentsProvider()
    {
        $data = array();

        /*
         * -a
         */
        $data[0] = array(
            array('-a'),
            array('params' => array(), 'a' => NULL)
        );

        $data[1] = array(
            array('--', '-a'),
            array('params' => array('-a'))
        );

        $data[2] = array(
            array('-a', '--'),
            array('params' => array(), 'a' => NULL)
        );

        /*
         * -a -b
         */
        $data[3] = array(
            array('-a', '-b'),
            array('params' => array(), 'a' => NULL, 'b' => NULL)
        );

        $data[4] = array(
            array('--', '-a', '-b'),
            array('params' => array('-a', '-b'))
        );

        $data[5] = array(
            array('-a', '--', '-b'),
            array('params' => array('-b'), 'a' => NULL)
        );

        $data[6] = array(
            array('-a', '-b', '--'),
            array('params' => array(), 'a' => NULL, 'b' => NULL)
        );

        /*
         * -a x b
         */
        $data[7] = array(
            array('-a', 'x', '-b'),
            array('params' => array(), 'a' => 'x', 'b' => NULL)
        );

        $data[8] = array(
            array('--', '-a', 'x', '-b'),
            array('params' => array('-a', 'x', '-b'))
        );

        $data[9] = array(
            array('-a', '--', 'x', '-b'),
            array('params' => array('x', '-b'), 'a' => NULL)
        );

        $data[10] = array(
            array('-a', 'x', '--', '-b'),
            array('params' => array('-b'), 'a' => 'x')
        );

        $data[11] = array(
            array('-a', 'x', '-b', '--'),
            array('params' => array(), 'a' => 'x', 'b' => NULL)
        );

        /*
         * -a -b y
         */
        $data[] = array(
            array('-a', '-b', 'y'),
            array('params' => array(), 'a' => NULL, 'b' => 'y')
        );
        $data[] = array(
            array('--', '-a', '-b', 'y'),
            array('params' => array('-a', '-b', 'y'))
        );
        $data[] = array(
            array('-a', '--', '-b', 'y'),
            array('params' => array('-b', 'y'), 'a' => NULL)
        );
        $data[] = array(
            array('-a', '-b', '--', 'y'),
            array('params' => array('y'), 'a' => NULL, 'b' => NULL)
        );
        $data[] = array(
            array('-a', '-b', 'y', '--'),
            array('params' => array(), 'a' => NULL, 'b' => 'y')
        );

        /*
         * -a x -b -y
         */
        $data[] = array(
            array('-a', 'x', '-b', 'y'),
            array('params' => array(), 'a' => 'x', 'b' => 'y')
        );
        $data[] = array(
            array('--', '-a', 'x', '-b', 'y'),
            array('params' => array('-a', 'x', '-b', 'y'))
        );
        $data[] = array(
            array('-a', '--', 'x', '-b', 'y'),
            array('params' => array('x', '-b', 'y'), 'a' => NULL)
        );
        $data[] = array(
            array('-a', 'x', '--', '-b', 'y'),
            array('params' => array('-b', 'y'), 'a' => 'x')
        );
        $data[] = array(
            array('-a', 'x', '-b', '--', 'y'),
            array('params' => array('y'), 'a' => 'x', 'b' => NULL)
        );

        $data[] = array(
            array('-a', 'x', '-b', 'y', '--'),
            array('params' => array(), 'a' => 'x', 'b' => 'y')
        );

        /*
         * --ab
         */
        $data[] = array(
            array('--ab'),
            array('params' => array(), 'ab' => NULL)
        );
        $data[] = array(
            array('--', '--ab'),
            array('params' => array('--ab'))
        );
        $data[] = array(
            array('--ab', '--'),
            array('params' => array(), 'ab' => NULL)
        );
        
        /*
         * --ab=cd
         */
        $data[] = array(
            array('--ab=cd'),
            array('params' => array(), 'ab' => 'cd')
        );
        $data[] = array(
            array('--', '--ab=cd'),
            array('params' => array('--ab=cd'))
        );
        $data[] = array(
            array('--ab=cd', '--'),
            array('params' => array(), 'ab' => 'cd')
        );
        
        /*
         * (empty)
         */
        $data[] = array(
            array(),
            array('params' => array())
        );
        
        $data[] = array(
            array('--'),
            array('params' => array())
        );
        
        /*
         * -a x --ab=cd
         */
        $data[] = array(
            array('-a', 'x', '--ab=cd'),
            array('params' => array(), 'a' => 'x', 'ab' => 'cd')
        );
        
        $data[] = array(
            array('--', '-a', 'x', '--ab=cd'),
            array('params' => array('-a', 'x', '--ab=cd'))
        );
        
        $data[] = array(
            array('-a', '--', 'x', '--ab=cd'),
            array('params' => array('x', '--ab=cd'), 'a' => NULL)
        );
        
        $data[] = array(
            array('-a',  'x', '--','--ab=cd'),
            array('params' => array('--ab=cd'), 'a' => 'x')
        );
        
        $data[] = array(
            array('-a', 'x', '--ab=cd', '--'),
            array('params' => array(), 'a' => 'x', 'ab' => 'cd')
        );
        
        /*
         * --ab=cd -a x
         */
        $data[] = array(
            array('--ab=cd', '-a', 'x'),
            array('params' => array(), 'ab' => 'cd', 'a' => 'x')
        );
        
        $data[] = array(
            array('--', '--ab=cd', '-a', 'x'),
            array('params' => array('--ab=cd', '-a', 'x'))
        );
        
        $data[] = array(
            array('--ab=cd', '--', '-a', 'x'),
            array('params' => array('-a', 'x'), 'ab' => 'cd')
        );
        
        $data[] = array(
            array('--ab=cd', '-a', '--', 'x'),
            array('params' => array('x'), 'ab' => 'cd', 'a' => NULL)
        );
        
        $data[] = array(
            array('--ab=cd', '-a', 'x', '--'),
            array('params' => array(), 'ab' => 'cd', 'a' => 'x')
        );
        
        
        /*
         * --ab=cd x -b y
         */
        $data[] = array(
            array('--ab=cd', 'x', '-b', 'y'),
            array('params' => array('x'), 'ab' => 'cd', 'b' => 'y')
        );
        
        $data[] = array(
            array('--', '--ab=cd', 'x', '-b', 'y'),
            array('params' => array('--ab=cd', 'x', '-b', 'y'))
        );
        
        $data[] = array(
            array('--ab=cd', '--', 'x', '-b', 'y'),
            array('params' => array('x', '-b', 'y'), 'ab' => 'cd')
        );
        
        $data[] = array(
            array('--ab=cd', 'x', '--', '-b', 'y'),
            array('params' => array('x', '-b', 'y'), 'ab' => 'cd', 'a' => NULL)
        );
        
        $data[] = array(
            array('--ab=cd', 'x', '-b', '--', 'y'),
            array('params' => array('x', 'y'), 'ab' => 'cd', 'b' => NULL)
        );
        
        $data[] = array(
            array('--ab=cd', 'x', '-b', 'y', '--'),
            array('params' => array('x'), 'ab' => 'cd', 'b' => 'y')
        );

        return $data;
    }

    /**
     * @covers PAF_Cli_Tool::isShortOption
     * @dataProvider isShortOptionProvider
     */
    public function testIsShortOption($input, $expected)
    {
        $this->assertEquals($expected, $this->object->isShortOption($input));
    }

    public function isShortOptionProvider()
    {
        $data = array();

        $data[] = array('--', false);
        $data[] = array('-', false);
        $data[] = array('---', false);
        $data[] = array('-a', true);
        $data[] = array('--a', false);
        $data[] = array('a--', false);
        $data[] = array('a-', false);
        $data[] = array('-a-', false);

        return $data;
    }

    /**
     * @covers PAF_Cli_Tool::isLongOption
     * @dataProvider isLongOptionProvider
     */
    public function testIsLongOption($input, $expected)
    {
        $this->assertEquals($expected, $this->object->isLongOption($input));
    }

    public function isLongOptionProvider()
    {
        $data = array();

        $data[] = array('--', false);
        $data[] = array('-', false);
        $data[] = array('---', true);
        $data[] = array('-a', false);
        $data[] = array('--a', true);
        $data[] = array('a--', false);
        $data[] = array('a-', false);
        $data[] = array('-a-', false);

        return $data;
    }

    /**
     * @covers PAF_Cli_Tool::isNotValue
     * @dataProvider isNotValueProvider
     */
    public function testIsNotValue($input, $expected)
    {
        $this->assertEquals($expected, $this->object->isNotValue($input));
    }

    public function isNotValueProvider()
    {
        $data = array();

        $data[] = array('--', true);
        $data[] = array('-', false);
        $data[] = array('---', true);
        $data[] = array('-a', true);
        $data[] = array('--a', true);
        $data[] = array('a--', false);
        $data[] = array('a-', false);
        $data[] = array('-a-', false);

        return $data;
    }

    /**
     * @covers PAF_Cli_Tool::isOptionTerminator
     * @dataProvider isOptionTerminatorProvider
     */
    public function testIsOptionTerminator($input, $expected)
    {
        $this->assertEquals($expected, $this->object->isOptionTerminator($input));
    }

    public function isOptionTerminatorProvider()
    {
        $data = array();

        $data[] = array('--', true);
        $data[] = array('-', false);
        $data[] = array('---', false);
        $data[] = array('-a', false);
        $data[] = array('--a', false);
        $data[] = array('a--', false);
        $data[] = array('a-', false);
        $data[] = array('-a-', false);

        return $data;
    }

}
