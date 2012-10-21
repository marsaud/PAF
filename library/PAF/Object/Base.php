<?php

/**
 *
 */

/**
 * Description of PAF_Object_Base
 *
 * @author fabrice
 */
abstract class PAF_Object_Base
{

    /**
     * Every sub-type of PAF_Object_Base will cache it's property access way
     * (use of get/set methods or direct attribute) in this static object.
     *
     * @var stdClass
     */
    private static $_cache = NULL;

    /**
     * Initializes the property cache object
     *
     * @return void
     */
    private static function _initCache()
    {
        if (NULL === self::$_cache)
        {
            self::$_cache = new stdClass();
        }
    }

    /**
     * Whether {@link _initObject} has been called or not.
     * @var type
     */
    private $_initialized;
    /**
     * The readable properties
     *
     * @var string[]
     */
    protected $_readProperties = array();
    /**
     * The writable properties
     *
     * @var string[]
     */
    protected $_writeProperties = array();

    /**
     * Declares public read properties and links them to a non-public
     * attribute/accessor name.
     *
     * Example :
     *
     * $this->_extendReadProperties(array('temperature' => 'tmp'));
     *
     * This declaration will make a sub-type able to evaluate property
     * $this->temperature by calling $this->_getTmp() if available, or simply
     * returning $this->_tmp.
     *
     * @param array $properties The read properties to add to the class when
     * extending.
     *
     * @return void
     */
    protected function _extendReadProperties(array $properties)
    {
        $this->_readProperties = array_merge(
            $this->_readProperties, $properties
        );
    }

    /**
     * Declares public write properties and links them to a non-public
     * attribute/accessor name.
     *
     * Example :
     *
     * $this->_extendWriteProperties(array('temperature' => 'tmp'));
     *
     * This declaration will make a sub-type able to assign property
     * $this->temperature = $value by calling $this->_setTmp($value) if
     * available, or simply assigning $this->_tmp = $value.
     *
     * @param array $properties The write properties to add to the class when
     * extending.
     *
     * @return void
     */
    protected function _extendWriteProperties(array $properties)
    {
        $this->_writeProperties = array_merge(
            $this->_writeProperties, $properties
        );
    }

    /**
     * Declares public read & write properties.
     *
     * @param array $properties The properties to add to the class when
     * extending.
     *
     * @return void
     *
     * @see _extendReadProperties
     * @see _extendWriteProperties
     */
    protected function _extendProperties(array $properties)
    {
        $this->_extendReadProperties($properties);
        $this->_extendWriteProperties($properties);
    }

    /**
     * This method SHOULD be implemented to call the
     * _extend(Read|Write)?Properties methods when extending.
     *
     * When extending, this method MUST call it's parent method if it exists.
     *
     * @return void
     *
     * @codeCoverageIgnore
     */
    abstract protected function _initProperties();

    /**
     * Initialization method reachable intended to be reached by
     * {@link __constructor},{@link __get}, and {@link __set}, as some PHP
     * extensions like pdo or php_soap instanciate objects by assigning
     * properties before calling constructor.
     *
     * @return void
     */
    private function _initObject()
    {
        if (!$this->_initialized)
        {
            $this->_initProperties();
            $this->_initialized = true;
        }
    }

    /**
     * This MUST be called by all sub-type constructors.
     */
    public function __construct()
    {
        $this->_initObject();
    }

    /**
     * This MAY be called by all sub-types when overriding __get.
     *
     * @param string $name Property name
     *
     * @return mixed Property value.
     *
     * @throws PAF_Exception_NoSuchIdentifier
     * @throws PAF_Exception_NoSuchProperty
     */
    public function __get($name)
    {
        $this->_initObject();

        if (!array_key_exists($name, $this->_readProperties))
        {
            throw new PAF_Exception_NoSuchIdentifier(); // @todo
        }

        self::_initCache();
        $class = get_class($this);
        if ($accessor = $this->_accessorLookUp(
            $class, $this->_readProperties[$name]
        ))
        {
            return $this->{$accessor}();
        }
        elseif ($attribute = $this->_attributeLookUp(
            $class, $this->_readProperties[$name]
        ))
        {
            return $this->{$attribute};
        }
        else
        {
            throw new PAF_Exception_NoSuchProperty(); // @todo
        }
    }

    /**
     * This MAY be called by all sub-types when overriding __set.
     *
     * @param type $name Property name.
     * @param type $value Value to assign.
     *
     * @return void
     *
     * @throws PAF_Exception_NoSuchIdentifier
     * @throws PAF_Exception_NoSuchProperty
     */
    public function __set($name, $value)
    {
        $this->_initObject();

        if (!array_key_exists($name, $this->_writeProperties))
        {
            throw new PAF_Exception_NoSuchIdentifier(); // @todo
        }

        self::_initCache();
        $class = get_class($this);
        if ($accessor = $this->_accessorLookUp(
            $class, $this->_writeProperties[$name], true
        ))
        {
            $this->{$accessor}($value);
        }
        elseif ($attribute = $this->_attributeLookUp(
            $class, $this->_writeProperties[$name], true
        ))
        {
            $this->{$attribute} = $value;
        }
        else
        {
            throw new PAF_Exception_NoSuchProperty(); // @todo
        }
    }

    /**
     * Determines if the encapsulated way to evaluate or assign property is to
     * call a member attribute, and caches it.
     *
     * @param string $class The type of the instance at work.
     * @param string $name The name to look for.
     * @param boolean $forWrite Wether the property is accessed for reading or
     * writing.
     *
     * @return string|boolean The final attribue name, or false.
     */
    private function _attributeLookUp($class, $name, $forWrite = false)
    {
        $id = $class . '_' . $name . '_att';
        if (!isset(self::$_cache->{$id}))
        {
            $attribs = get_class_vars($class);
            self::$_cache->{$id} =
                array_key_exists('_' . $name, $attribs) ? '_' . $name : false;
        }

        return self::$_cache->{$id};
    }

    /**
     * Determines if the encapsulated way to evaluate or assign property is to
     * call an accessor, and caches it.
     *
     * @param string $class The type of the instance at work.
     * @param string $name The name to look for.
     * @param boolean $forWrite Wether the property is accessed for reading or
     * writing.
     *
     * @return string|boolean The final accessor name, or false.
     */
    private function _accessorLookUp($class, $name, $forWrite = false)
    {
        $prefix = $forWrite ? 'set' : 'get';
        $id = $class . '_' . $name . '_' . $prefix;
        $method = '_' . $prefix . ucfirst($name);
        if (!isset(self::$_cache->{$id}))
        {
            $methods = get_class_methods($class);
            self::$_cache->{$id} =
                in_array($method, $methods) ? $method : false;
        }

        return self::$_cache->{$id};
    }

}